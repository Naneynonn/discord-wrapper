<?php

declare(strict_types=1);

namespace Naneynonn\Api;

use Naneynonn\Enums\RequestTypes;
use Naneynonn\Http\HttpClient;

use Naneynonn\Util\Cache;
use Naneynonn\Util\ConfigValidator;
use Naneynonn\Util\HttpUtils;

use Predis\Client as RedisClient;

use InvalidArgumentException;
use JsonException;
use RuntimeException;

final class Client
{
  private HttpClient $http;
  private RedisClient $redis;

  private string $token;
  private array $services = [];

  public function __construct(array $config)
  {
    ConfigValidator::validate($config);

    $this->token = $config['bot']['token'];
    $this->redis = $config['cache'] ?? new RedisClient();

    $this->http = new HttpClient(proxy: $config['proxy'] ?? null, retry: $config['retry'] ?? true, timeout: (float) ($config['timeout'] ?? 10.0), connectTimeout: (float) ($config['connect_timeout'] ?? 3.0));
  }

  public function apiRequest(RequestTypes $method, string $url, array $options = [], string $authType = 'bot', ?string $customKey = null, ?int $cache_ttl = null): array
  {
    $options = $this->buildOptions(method: $method, authType: $authType, options: $options);
    $params = $this->buildCacheParams(url: $url, options: $options, customKey: $customKey);

    $ttl = ($method === RequestTypes::GET)
      ? ($cache_ttl ?? 0)
      : 0;

    $lastStatus = null;
    $lastContentType = '';
    $lastBody = null;

    try {
      $bodyFunction = function () use ($method, $url, $options, &$lastStatus, &$lastContentType, &$lastBody): string {
        $response = $this->http->sendResponse(method: $method, url: $url, options: $options);
        $body = $response->getBody()->getContents();

        $lastStatus = $response->getStatusCode();
        $lastContentType = $response->getHeaderLine('Content-Type');
        $lastBody = $body;

        return $body;
      };

      $shouldCache = static function () use (&$lastStatus): bool {
        return $lastStatus !== null && $lastStatus >= 200 && $lastStatus < 300;
      };

      return Cache::request(redis: $this->redis, fn: $bodyFunction, params: $params, ttl: $ttl, shouldCache: $shouldCache) ?? [];
    } catch (JsonException $e) {
      if ($lastStatus !== null && ($lastStatus < 200 || $lastStatus >= 300)) {
        return [
          'code' => $lastStatus,
          'message' => self::httpErrorMessage(status: $lastStatus, body: $lastBody ?? ''),
        ];
      }

      $context = [];

      if ($lastStatus !== null) {
        $context[] = "HTTP {$lastStatus}";
      }

      if ($lastContentType !== '') {
        $context[] = "Content-Type {$lastContentType}";
      }

      $suffix = !empty($context)
        ? ' (' . implode(', ', $context) . ')'
        : '';
      $preview = self::bodyPreview($lastBody ?? '');

      throw new RuntimeException('Failed to decode JSON response' . $suffix . ': ' . $e->getMessage() . ($preview !== '' ? ". Body: {$preview}" : ''), previous: $e);
    }
  }

  public function request(RequestTypes $method, string $endpoint, array $options = [], ?int $cache_ttl = null): array
  {
    $url = $endpoint;

    if (!empty($options['params'])) {
      $url = $this->generateUrl(endpoint: $endpoint, params: $options['params']);
    }

    if (!empty($options['reason'])) {
      $auditLogHeader = HttpUtils::withAuditLogReason($options['reason']);
      $options['headers'] = array_merge($options['headers'] ?? [], $auditLogHeader);
    }

    unset($options['params'], $options['reason']);

    return $this->apiRequest(method: $method, url: $url, options: $options, cache_ttl: $cache_ttl);
  }

  public function __get($name)
  {
    $serviceName = ucfirst(strtolower($name));
    $className = "\\Naneynonn\\Rest\\{$serviceName}";

    if (!isset($this->services[$name])) {
      if (class_exists($className)) {
        $this->services[$name] = new $className($this);
      }
    }

    return $this->services[$name];
  }

  private static function httpErrorMessage(int $status, string $body): string
  {
    $preview = self::bodyPreview($body);
    return "Discord API error ({$status})" . ($preview !== '' ? ": {$preview}" : '');
  }

  private static function bodyPreview(string $body): string
  {
    if ($body === '') {
      return '';
    }

    $body = html_entity_decode(strip_tags($body), ENT_QUOTES | ENT_HTML5, 'UTF-8');
    $body = preg_replace('/\s+/u', ' ', $body) ?? $body;
    $body = trim($body);

    if (strlen($body) > 500) {
      $body = substr($body, 0, 500) . '…';
    }

    return $body;
  }

  private function generateUrl(string $endpoint, array $params): string
  {
    foreach ($params as $key => $value) {
      $endpoint = str_replace("{{$key}}", $value, $endpoint);
    }
    return $endpoint;
  }

  private function buildCacheParams(string $url, array $options, ?string $customKey = null): array
  {
    return !is_null($customKey)
      ? ['custom_key' => $customKey]
      : ['url' => $url, 'options' => $options];
  }

  private function getHeadersByType(string $type, RequestTypes $method): array
  {
    $headers = match ($type) {
      'bot'    => ['Authorization' => 'Bot ' . $this->token],
      'bearer' => ['Authorization' => 'Bearer ' . ($_SESSION['access_token'] ?? '')],
      default  => throw new InvalidArgumentException("Invalid auth type: {$type}"),
    };

    if ($method !== RequestTypes::DELETE) {
      $headers['Content-Type'] = $type === 'bot'
        ? 'application/json'
        : 'application/x-www-form-urlencoded';
    }

    return $headers;
  }

  private function buildOptions(RequestTypes $method, string $authType, array $options = []): array
  {
    $defaultHeaders = $this->getHeadersByType(type: $authType, method: $method);

    $options['headers'] = isset($options['headers']) && is_array($options['headers'])
      ? array_merge($defaultHeaders, $options['headers'])
      : $defaultHeaders;

    return $options;
  }
}

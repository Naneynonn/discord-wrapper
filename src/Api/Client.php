<?php

declare(strict_types=1);

namespace Naneynonn\Api;

use Naneynonn\Http\HttpClient;
use Naneynonn\Http\NullCache;

use Naneynonn\Util\ConfigValidator;
use Naneynonn\Util\HttpUtils;
use Naneynonn\Util\Cache;

use Naneynonn\Enums\RequestTypes;

use Predis\Client as RedisClient;

use JsonException;
use RuntimeException;
use InvalidArgumentException;

final class Client
{
  private HttpClient $http;
  private RedisClient|NullCache $redis;

  private string $token;
  private array $services = [];

  public function __construct(array $config)
  {
    ConfigValidator::validate($config);

    $this->token = $config['bot']['token'];

    $this->redis = $config['cache'] ?? (
      class_exists(RedisClient::class)
      ? new RedisClient()
      : new NullCache()
    );

    $this->http = new HttpClient(
      proxy: $config['proxy'] ?? null,
      retry: $config['retry'] ?? true,
    );
  }

  public function apiRequest(RequestTypes $method, string $url, array $options = [], string $authType = 'bot', ?string $customKey = null, ?int $cache_ttl = null): array
  {
    $options = $this->buildOptions(method: $method, authType: $authType, options: $options);
    $params = $this->buildCacheParams(url: $url, options: $options, customKey: $customKey);

    try {
      $bodyFunction = fn() => $this->http->send(method: $method, url: $url, options: $options);

      return Cache::request(redis: $this->redis, fn: $bodyFunction, params: $params, ttl: $cache_ttl ?? 0) ?? [];
    } catch (JsonException $e) {
      throw new RuntimeException("Failed to decode JSON response: " . $e->getMessage());
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
      'bearer' => ['Authorization' => 'Bearer ' . $_SESSION['access_token']],
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

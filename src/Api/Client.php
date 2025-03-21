<?php

declare(strict_types=1);

namespace Naneynonn\Api;

use Naneynonn\Util\RateLimitHandler;
use Naneynonn\Util\ConfigValidator;
use Naneynonn\Util\HttpUtils;

use Naneynonn\Cache\CacheManager;
use Naneynonn\Const\Config;
use Naneynonn\Enums\RequestTypes;

use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Exception\GuzzleException;

use JsonException;
use RuntimeException;
use InvalidArgumentException;

final class Client extends HttpUtils
{
  use Config;

  private GuzzleClient $http;
  private CacheManager $cache;
  private string $token;

  private ?array $proxy = null;
  private bool $retry = true;
  private array $services = [];

  public function __construct(array $config)
  {
    ConfigValidator::validate($config);

    $this->token = $config['bot']['token'];
    $this->proxy = $config['proxy'] ?? $this->proxy;
    $this->retry = $config['retry'] ?? $this->retry;

    $this->cache = new CacheManager;

    $this->startClient();
  }

  private function startClient(): void
  {
    $this->http = new GuzzleClient([
      'base_uri' => self::BASE_URI,
      'headers' => [
        'User-Agent' => self::HEADERS['User-Agent'],
        'Accept-Encoding' => self::HEADERS['Accept-Encoding'],
        'version' => self::HEADERS['version']
      ],
      'proxy' => $this->proxy,
      'http_errors' => false,
    ]);
  }

  public function apiRequest(RequestTypes $method, string $url, array $options = [], string $authType = 'bot', ?string $customKey = null, ?int $cache_ttl = null): array
  {
    $defaultHeaders = $this->getHeadersByType(type: $authType, method: $method);

    if (isset($options['headers']) && is_array($options['headers'])) {
      $options['headers'] = array_merge($defaultHeaders, $options['headers']);
    } else {
      $options['headers'] = $defaultHeaders;
    }

    try {
      $key = $this->cache->generateKey(url: $url, data: $options, customKey: $customKey);

      $bodyFunction = function () use ($method, $url, $options) {
        $request = fn() => $this->http->request(method: $method->value, uri: $url, options: $options);

        $response = $request();
        $response = RateLimitHandler::handle(response: $response, retryRequest: $request, retry: $this->retry);
        return $response->getBody()->getContents();
      };

      return $this->cache->requestWithCache(key: $key, requestFunction: $bodyFunction, ttl: $cache_ttl);
    } catch (GuzzleException $e) {
      throw new RuntimeException("HTTP request failed: " . $e->getMessage());
    } catch (JsonException $e) {
      throw new RuntimeException("Failed to decode JSON response: " . $e->getMessage());
    }
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

  private function getHeadersByType(string $type, RequestTypes $method): array
  {
    $headers = match ($type) {
      'bot' => [
        'Authorization' => 'Bot ' . $this->token,
      ],
      'bearer' => [
        'Authorization' => 'Bearer ' . $_SESSION['access_token'],
      ],
      default => throw new InvalidArgumentException("Invalid auth type: {$type}")
    };

    if ($method !== RequestTypes::DELETE) {
      $headers['Content-Type'] = $type === 'bot'
        ? 'application/json'
        : 'application/x-www-form-urlencoded';
    }

    return $headers;
  }


  public function request(RequestTypes $method, string $endpoint, array $options = [], ?int $cache_ttl = null): array
  {
    $url = $endpoint;

    if (!empty($options['params'])) {
      $url = $this->generateUrl(endpoint: $endpoint, params: $options['params']);
    }

    if (!empty($options['reason'])) {
      $auditLogHeader = self::withAuditLogReason($options['reason']);
      $options['headers'] = array_merge($options['headers'] ?? [], $auditLogHeader);
    }

    unset($options['params'], $options['reason']);

    return $this->apiRequest(method: $method, url: $url, options: $options, cache_ttl: $cache_ttl);
  }
}

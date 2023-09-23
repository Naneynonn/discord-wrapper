<?php

namespace Naneynonn;

use CurlHandle;

use Naneynonn\Const\Constants;
use Naneynonn\CacheManager;

class DiscordApiClient
{
  use Constants;

  private array $config;
  private ?CurlHandle $ch;
  private CacheManager $cacheManager;
  private ?array $proxy = null;

  private $objects = [];
  private $properties = [
    'guild' => 'Guild',
    'channel' => 'Channel',
    'user' => 'User',
    'invite' => 'Invite'
  ];

  public function __construct(array $config)
  {
    $this->validateConfig($config);

    $this->config = $config;
    $this->cacheManager = new CacheManager();

    if (isset($config['proxy'])) {
      $this->proxy = $config['proxy'];
    }

    $this->ch = curl_init();
  }

  public function __destruct()
  {
    if ($this->ch) {
      curl_close($this->ch);
      $this->ch = null;
    }
  }

  private function validateConfig(array $config): void
  {
    if (!isset($config['bot']['token'])) {
      throw new \InvalidArgumentException('Bot token must be provided in the configuration.');
    }

    // Проверка конфигурации прокси, если она предоставлена
    if (isset($config['proxy'])) {
      $requiredProxyFields = ['address', 'port', 'type'];
      foreach ($requiredProxyFields as $field) {
        if (!isset($config['proxy'][$field])) {
          throw new \InvalidArgumentException("Proxy configuration is missing the required field: {$field}.");
        }
      }

      // Проверка допустимости типа прокси
      $allowedProxyTypes = ['HTTP', 'SOCKS5'];
      if (!in_array($config['proxy']['type'], $allowedProxyTypes, true)) {
        throw new \InvalidArgumentException("Proxy type {$config['proxy']['type']} is not supported. Supported types are: " . implode(", ", $allowedProxyTypes));
      }

      // Если указаны username или password, оба должны быть предоставлены
      if (isset($config['proxy']['username']) || isset($config['proxy']['password'])) {
        if (!isset($config['proxy']['username']) || !isset($config['proxy']['password'])) {
          throw new \InvalidArgumentException("Proxy configuration requires both username and password if one of them is provided.");
        }
      }
    }
  }

  public function apiRequest(string $url, string $method, ?array $data = [], array $headers = [], array $options = [], ?int $cache_ttl = null, string $type = 'bot', bool $json = false, ?string $key = null)
  {
    $cache_key = '';

    // Заголовок авторизации по умолчанию
    if (empty($headers)) {
      $headers = $this->getHeadersByType($type);
    }

    $cache_key = $this->cacheManager->generateKey(url: $url, data: $data, customKey: $key);

    if ($cache_ttl) {
      $cached_response = $this->cacheManager->get(key: $cache_key);
      if ($cached_response) {
        return json_decode($cached_response, true);
      }
    }

    $this->prepareRequest($url, $method, $data, $headers, $options, $json);
    $response = $this->executeRequest();

    return $this->handleResponse(response: $response, cache_key: $cache_key, cache_ttl: $cache_ttl);
  }

  private function prepareRequest(string $url, string $method, ?array $data, array $headers, array $options, bool $json): void
  {
    curl_reset($this->ch);

    if (isset($options[CURLOPT_HTTPHEADER])) {
      $headers = array_merge($headers, $options[CURLOPT_HTTPHEADER]);
      unset($options[CURLOPT_HTTPHEADER]); // Удаляем, чтобы избежать повторной установки
    }

    curl_setopt($this->ch, CURLOPT_URL, $url);
    curl_setopt($this->ch, CURLOPT_CUSTOMREQUEST, $method);
    curl_setopt($this->ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($this->ch, CURLOPT_SSL_VERIFYHOST, 2);
    curl_setopt($this->ch, CURLOPT_SSL_VERIFYPEER, 1);
    curl_setopt($this->ch, CURLOPT_USERAGENT, 'Discord-Wrapper/1.0');

    if ($this->proxy) {
      curl_setopt($this->ch, CURLOPT_PROXY, $this->proxy['address']);
      curl_setopt($this->ch, CURLOPT_PROXYPORT, $this->proxy['port']);
      curl_setopt($this->ch, CURLOPT_PROXYTYPE, match ($this->proxy['type']) {
        'SOCKS5' => CURLPROXY_SOCKS5,
        'HTTP' => CURLPROXY_HTTP,
        default => throw new \InvalidArgumentException('Invalid proxy type specified.'),
      });
      if (isset($this->proxy['username']) && isset($this->proxy['password'])) {
        curl_setopt($this->ch, CURLOPT_PROXYUSERPWD, "{$this->proxy['username']}:{$this->proxy['password']}");
      }
    }

    if (is_null($data)) {
      curl_setopt($this->ch, CURLOPT_POSTFIELDS, NULL);
    } else if (!empty($data)) {
      curl_setopt($this->ch, CURLOPT_POSTFIELDS, match ($json) {
        true => json_encode($data, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE),
        false => http_build_query($data),
      });
    }

    // Применяем пользовательские опции
    if (!empty($options)) {
      foreach ($options as $option => $value) {
        curl_setopt($this->ch, $option, $value);
      }
    }
  }

  private function executeRequest(): string
  {
    $response = curl_exec($this->ch);

    if (curl_errno($this->ch)) {
      throw new \Exception(curl_error($this->ch));
    }

    return $response;
  }

  private function handleResponse(string $response, string $cache_key, ?int $cache_ttl = null): ?array
  {
    $http_code = curl_getinfo($this->ch, CURLINFO_HTTP_CODE);

    if ($http_code == 429) { // Превышен лимит запросов
      $response = json_decode($response, true, 512, JSON_THROW_ON_ERROR);
      session_write_close();
      usleep((int) ($response['retry_after'] * 1000));
      return $this->handleResponse(response: $this->executeRequest(), cache_key: $cache_key, cache_ttl: $cache_ttl);
    }

    // Если указано время жизни кеша, сохраняем данные в кеше
    if ($cache_ttl) {
      $this->cacheManager->set(key: $cache_key, value: $response, ttl: $cache_ttl);
    }

    return json_decode($response, true);
  }

  private function getHeadersByType(string $type): array
  {
    return match ($type) {
      'bot' => [
        'Content-Type: application/json',
        'Authorization: Bot ' . $this->config['bot']['token'],
      ],
      'bearer' => [
        'Content-Type: application/x-www-form-urlencoded',
        'Authorization: Bearer ' . $_SESSION['access_token']
      ],
      default => throw new \InvalidArgumentException("Invalid auth type: {$type}")
    };
  }

  private function generateUrl(string $endpoint, array $params): string
  {
    foreach ($params as $key => $value) {
      $endpoint = str_replace("{{$key}}", $value, $endpoint);
    }
    return self::URL . $endpoint;
  }

  public function request(string $method, string $endpoint, array $params = [], array $options = [], ?int $cache_ttl = null)
  {
    $url = $this->generateUrl($endpoint, $params);
    return $this->apiRequest(url: $url, method: $method, options: $options, cache_ttl: $cache_ttl);
  }

  /**
   * Magic getter for lazily initializing various API method handlers.
   *
   * @param string $name The property name.
   * @return mixed The initialized object for the API method.
   * @throws \Exception If the property name doesn't match any known handlers.
   */
  public function __get(string $name): object
  {
    if (!isset($this->objects[$name])) {
      $this->objects[$name] = $this->createApiMethodHandler($name);
    }

    return $this->objects[$name];
  }

  private function createApiMethodHandler(string $name): object
  {
    if (!array_key_exists($name, $this->properties)) {
      throw new \Exception("Undefined property: $name");
    }

    $class_name = "Naneynonn\Methods\\" . $this->properties[$name];
    return new $class_name($this);
  }
}

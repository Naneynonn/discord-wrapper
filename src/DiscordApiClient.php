<?php

namespace Naneynonn;

use Predis\Client as PredisClient;
use CurlHandle;

class DiscordApiClient
{
  private const NAME = 'wrapper';

  private array $config;
  private ?CurlHandle $ch;
  private PredisClient $predisClient;

  private $objects = [];
  private $properties = [
    'guild' => 'Guild',
    'channel' => 'Channel',
    'user' => 'User'
  ];

  public function __construct($config)
  {
    $this->config = $config;
    $this->predisClient = new PredisClient();

    $this->ch = curl_init();
  }

  public function __destruct()
  {
    if ($this->ch) {
      curl_close($this->ch);
      $this->ch = null;
    }
  }

  public function apiRequest(string $url, string $method, array $data = [], array $headers = [], array $options = [], ?int $cache_ttl = null, string $type = 'bot')
  {
    $cache_key = '';
    // Заголовок авторизации по умолчанию
    $default_headers = $this->getHeadersByType($type);

    if (empty($headers)) {
      $headers = $default_headers;
    }

    // Если указано время жизни кеша, попробуйте получить данные из кеша
    if ($cache_ttl) {
      $cache_key = self::NAME . ':' . md5($url . serialize($data));
      $cached_response = $this->predisClient->get($cache_key);
      if ($cached_response) {
        return json_decode($cached_response, true);
      }
    }

    $this->prepareRequest($url, $method, $data, $headers, $options);
    $response = $this->executeRequest();

    return $this->handleResponse(response: $response, cache_key: $cache_key, cache_ttl: $cache_ttl);
  }

  public function serverId(): string
  {
    return $this->config['guild']['id'];
  }

  private function getHeadersByType(string $type): array
  {
    if ($type == 'bot') {
      return [
        'Content-Type: application/json',
        'Authorization: Bot ' . $this->config['bot']['token'],
      ];
    } elseif ($type == 'bearer') {
      return [
        'Content-Type: application/x-www-form-urlencoded',
        'Authorization: Bearer ' . $_SESSION['access_token']
      ];
    }

    throw new \InvalidArgumentException("Invalid auth type: $type");
  }

  private function prepareRequest(string $url, string $method, array $data, array $headers, array $options): void
  {
    curl_reset($this->ch);

    curl_setopt($this->ch, CURLOPT_URL, $url);
    curl_setopt($this->ch, CURLOPT_CUSTOMREQUEST, $method);
    curl_setopt($this->ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($this->ch, CURLOPT_SSL_VERIFYHOST, 2);
    curl_setopt($this->ch, CURLOPT_SSL_VERIFYPEER, 1);

    if (!empty($data)) {
      curl_setopt($this->ch, CURLOPT_POSTFIELDS, http_build_query($data));
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

  private function handleResponse(string $response, string $cache_key, ?int $cache_ttl = null): array
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
      $this->predisClient->set($cache_key, $response, 'EX', $cache_ttl);
    }

    return json_decode($response, true);
  }

  public function __get($name)
  {
    if (array_key_exists($name, $this->properties)) {
      $class_name = "Naneynonn\Methods\\" . $this->properties[$name];
      if (!isset($this->objects[$name])) {
        $this->objects[$name] = new $class_name($this);
      }
      return $this->objects[$name];
    }
    throw new \Exception("Undefined property: $name");
  }
}

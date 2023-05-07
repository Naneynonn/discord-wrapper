<?php

namespace Naneynonn;

use Predis\Client as PredisClient;

use CurlHandle;

class DiscordApiClient
{
  private const VERSION = 'v10';
  private const API_URL = 'https://discord.com/api/';
  private const URL = self::API_URL . self::VERSION . '/';
  private const NAME = 'CacheBotPHP';

  private array $config;
  private ?CurlHandle $ch = null;
  private PredisClient $predisClient;

  public function __construct($config)
  {
    $this->config = $config;
    $this->predisClient = new PredisClient();
  }

  public function apiRequest(string $url, string $method, array $data = [], array $headers = [], array $options = [], ?int $cache_ttl = null)
  {
    // Заголовок авторизации по умолчанию
    $default_headers = [
      'Content-Type: application/json',
      'Authorization: Bot ' . $this->config['bot']['token'],
    ];

    $headers = array_merge($default_headers, $headers);

    // Если указано время жизни кеша, попробуйте получить данные из кеша
    if ($cache_ttl) {
      $cache_key = self::NAME . ':' . md5($url . serialize($data));
      $cached_response = $this->predisClient->get($cache_key);
      if ($cached_response) {
        return json_decode($cached_response, true);
      }
    }

    if (!$this->ch) {
      $this->ch = curl_init();
    }

    curl_setopt($this->ch, CURLOPT_URL, $url);
    curl_setopt($this->ch, CURLOPT_CUSTOMREQUEST, $method);
    curl_setopt($this->ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($this->ch, CURLOPT_SSL_VERIFYHOST, 2);
    curl_setopt($this->ch, CURLOPT_SSL_VERIFYPEER, 1);

    if (!empty($data)) {
      curl_setopt($this->ch, CURLOPT_POSTFIELDS, json_encode($data));
    }

    // Применяем пользовательские опции
    if (!empty($options)) {
      foreach ($options as $option => $value) {
        curl_setopt($this->ch, $option, $value);
      }
    }

    $response = curl_exec($this->ch);

    $http_code = curl_getinfo($this->ch, CURLINFO_HTTP_CODE);

    if ($http_code == 429) { // Превышен лимит запросов
      $headers = curl_getinfo($this->ch, CURLINFO_HEADER_OUT);
      $rate_limit_reset = (int)$headers['X-RateLimit-Reset-After'];
      sleep($rate_limit_reset);
      $response = $this->apiRequest($url, $method, $data, $headers, $options, $cache_ttl);
    }

    if (curl_errno($this->ch)) {
      $error_msg = curl_error($this->ch);
      // Обработка ошибок, например, запись в лог-файл
    }

    // Если указано время жизни кеша, сохраняем данные в кеше
    if ($cache_ttl) {
      $this->predisClient->set($cache_key, $response, 'EX', $cache_ttl);
    }

    return json_decode($response, true);
  }

  public function closeConnection(): void
  {
    if ($this->ch) {
      curl_close($this->ch);
      $this->ch = null;
    }
  }

  public function getGuild(array $options = [], ?int $cache_ttl = null)
  {
    $url = 'https://discord.com/api/guilds/' . $this->config['guild']['id'];
    $method = "GET";
    return $this->apiRequest(url: $url, method: $method, options: $options, cache_ttl: $cache_ttl);
  }

  public function getGuildChannels(array $options = [], ?int $cache_ttl = null)
  {
    $url = 'https://discord.com/api/guilds/' . $this->config['guild']['id'] . '/channels';
    $method = "GET";
    return $this->apiRequest(url: $url, method: $method, options: $options, cache_ttl: $cache_ttl);
  }

  // Дополнительные методы для работы с Discord API
}

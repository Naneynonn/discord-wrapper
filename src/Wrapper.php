<?php

class DiscordApiClient
{
  private $config;

  public function __construct($config)
  {
    $this->config = $config;
  }

  public function apiRequest($url, $method, $data = [], $headers = [], $options = [])
  {
    $default_headers = [
      'Content-Type: application/json',
    ];

    $headers = array_merge($default_headers, $headers);

    if (!$ch) {
      $ch = curl_init();
    }

    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);

    if (!empty($data)) {
      curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    }

    // Apply custom options
    if (!empty($options)) {
      foreach ($options as $option => $value) {
        curl_setopt($ch, $option, $value);
      }
    }

    $response = curl_exec($ch);

    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

    if ($http_code == 429) { // Rate limit exceeded
      $headers = curl_getinfo($ch, CURLINFO_HEADER_OUT);
      $rate_limit_reset = (int)$headers['X-RateLimit-Reset-After']; // Time in seconds to wait before making another request
      sleep($rate_limit_reset); // Wait before making another request
      $response = discordApiRequest($url, $method, $data, $headers, $options, $reuse_connection, $ch); // Retry the request after waiting
    }

    if (curl_errno($ch)) {
      $error_msg = curl_error($ch);
      // Обработка ошибок, например, запись в лог-файл
    }

    if (!$reuse_connection) {
      curl_close($ch);
    }

    return json_decode($response, true);
  }

  public function getGuild()
  {
    $url = 'https://discord.com/api/guilds/' . $this->config['guild']['id'];
    $method = "GET";
    $headers = ['Authorization: Bot ' . $this->config['bot']['token']];
    return $this->apiRequest($url, $method, [], $headers);
  }

  public function getGuildChannels()
  {
    $url = 'https://discord.com/api/guilds/' . $this->config['guild']['id'] . '/channels';
    $method = "GET";
    $headers = ['Authorization: Bot ' . $this->config['bot']['token']];
    return $this->apiRequest($url, $method, [], $headers);
  }

  // Дополнительные методы для работы с Discord API
}

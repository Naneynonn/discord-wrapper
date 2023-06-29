<?php

namespace Naneynonn;

use Naneynonn\DiscordApiClient;
use Naneynonn\Constants;

class DiscordOauth extends Constants
{
  private DiscordApiClient $api;

  public function __construct(DiscordApiClient $api)
  {
    $this->api = $api;
  }

  public function urlOauth(string $clientId, string $redirect, string $scope): string
  {
    return self::DISCORD . '/oauth2/authorize?' . http_build_query([
      'prompt' => 'none',
      'response_type' => 'code',
      'client_id' => $clientId,
      'redirect_uri' => $redirect,
      'scope' => $scope,
      'state' => $this->genState()
    ]);
  }

  public function init($redirect_url, $client_id, $client_secret): void
  {
    $code = $_GET['code'];
    $url = self::URL . '/oauth2/token';
    $method = 'POST';
    $data = [
      "client_id" => $client_id,
      "client_secret" => $client_secret,
      "grant_type" => "authorization_code",
      "code" => $code,
      "redirect_uri" => $redirect_url
    ];
    $headers = ['Content-Type: application/x-www-form-urlencoded'];

    $response = $this->api->apiRequest(url: $url, method: $method, data: $data, headers: $headers);
    $_SESSION['access_token'] = $response['access_token'];
  }

  public function getUser(): void
  {
    $url = self::URL . "/users/@me";

    $response = $this->api->apiRequest(url: $url, method: 'GET', type: 'bearer');

    $_SESSION['user'] = $response;
    $_SESSION['username'] = $response['username'];
    $_SESSION['discrim'] = $response['discriminator'];
    $_SESSION['user_id'] = $response['id'];
    $_SESSION['user_avatar'] = $response['avatar'];
  }

  public function getGuilds(?int $cache_ttl = null)
  {
    $url = self::URL . "/users/@me/guilds";
    $key = $_SESSION['access_token'] . ':guilds';

    return $this->api->apiRequest(url: $url, method: 'GET', type: 'bearer', cache_ttl: $cache_ttl, key: $key);
  }

  public function getGuild(string $id)
  {
    $url = self::URL . "/guilds/{$id}";

    return $this->api->apiRequest(url: $url, method: 'GET', type: 'bearer');
  }

  public function connectToGuild(string $id)
  {
    $user = $_SESSION['user_id'];
    $url = self::URL . "/guilds/{$id}/members/{$user}";

    $data = ['access_token' => $_SESSION['access_token']];

    return $this->api->apiRequest(url: $url, method: 'PUT', data: $data, json: true);
  }

  public function genState(): string
  {
    return bin2hex(openssl_random_pseudo_bytes(12));
  }

  public function isUnauthorized(array $response, string $back_url): void
  {
    if (isset($response['code']) && $response['code'] === 0) {
      header("Location: {$back_url}");
      die();
    }
  }
}

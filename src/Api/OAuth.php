<?php

declare(strict_types=1);

namespace Naneynonn\Api;

use Naneynonn\Const\Config;
use Naneynonn\Api\Client;
use Naneynonn\Enums\RequestTypes;

final class OAuth
{
  use Config;

  private Client $api;

  public function __construct(Client $api)
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

  public function init(string $redirect_url, string $client_id, string $client_secret): void
  {
    $code = $_GET['code'] ?? '';

    $options = [
      'form_params' => [
        "grant_type" => "authorization_code",
        "code" => $code,
        "redirect_uri" => $redirect_url
      ],
      'headers' => [
        'Content-Type' => 'application/x-www-form-urlencoded'
      ],
      'auth' => [
        $client_id,
        $client_secret
      ]
    ];

    $response = $this->api->apiRequest(method: RequestTypes::POST, url: 'oauth2/token', options: $options);
    $_SESSION['access_token'] = $response['access_token'] ?? '';
  }

  public function getUser(): void
  {
    $response = $this->api->apiRequest(method: RequestTypes::GET, url: 'users/@me', authType: 'bearer');

    $_SESSION['user'] = $response;
    $_SESSION['username'] = $response['username'];
    $_SESSION['discrim'] = $response['discriminator'];
    $_SESSION['user_id'] = $response['id'];
    $_SESSION['user_avatar'] = $response['avatar'];
  }

  public function getGuilds(?int $cache_ttl = 600): array
  {
    $key = $_SESSION['access_token'] . ':guilds';
    return $this->api->apiRequest(method: RequestTypes::GET, url: 'users/@me/guilds', authType: 'bearer', customKey: $key, cache_ttl: $cache_ttl);
  }

  public function getGuild(string $id): array
  {
    return $this->api->apiRequest(method: RequestTypes::GET, url: "guilds/{$id}", authType: 'bearer');
  }

  public function connectToGuild(string $id): array
  {
    $user = $_SESSION['user_id'];

    $options = [
      'json' => [
        'access_token' => $_SESSION['access_token']
      ]
    ];

    return $this->api->apiRequest(method: RequestTypes::PUT, url: "guilds/{$id}/members/{$user}", options: $options);
  }

  public function genState(): string
  {
    return bin2hex(random_bytes(12));
  }
}

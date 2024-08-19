<?php

declare(strict_types=1);

namespace Naneynonn\Rest;

use Naneynonn\Api\Client;
use Naneynonn\Enums\RequestTypes;

final class User
{
  private Client $api;

  public function __construct(Client $api)
  {
    $this->api = $api;
  }

  public function getCurrentUser(?int $cache_ttl = 600): array
  {
    return $this->api->request(
      method: RequestTypes::GET,
      endpoint: "users/@me",
      cache_ttl: $cache_ttl
    );
  }

  public function getUser(string $user_id, ?int $cache_ttl = 600): array
  {
    return $this->api->request(
      method: RequestTypes::GET,
      endpoint: "users/{$user_id}",
      cache_ttl: $cache_ttl
    );
  }

  public function modifyCurrentUser(array $params = [], ?int $cache_ttl = null): array
  {
    return $this->api->request(
      method: RequestTypes::PATCH,
      endpoint: "users/@me",
      options: [
        'json' => $params
      ],
      cache_ttl: $cache_ttl
    );
  }

  public function getCurrentUserGuilds(array $params = [], ?int $cache_ttl = 600): array
  {
    return $this->api->request(
      method: RequestTypes::GET,
      endpoint: "users/@me/guilds",
      options: [
        'query' => $params
      ],
      cache_ttl: $cache_ttl
    );
  }

  public function getCurrentUserGuildMember(string $guild_id, ?int $cache_ttl = 600): array
  {
    return $this->api->request(
      method: RequestTypes::GET,
      endpoint: "users/@me/guilds/{$guild_id}/member",
      cache_ttl: $cache_ttl
    );
  }

  public function leaveGuild(string $guild_id, ?int $cache_ttl = null): array
  {
    return $this->api->request(
      method: RequestTypes::DELETE,
      endpoint: "users/@me/guilds/{$guild_id}",
      options: [
        'json' => []
      ],
      cache_ttl: $cache_ttl
    );
  }

  public function createDM(array $params = [], ?int $cache_ttl = null): array
  {
    return $this->api->request(
      method: RequestTypes::POST,
      endpoint: "users/@me/channels",
      options: [
        'json' => $params
      ],
      cache_ttl: $cache_ttl
    );
  }

  public function createGroupDM(array $params = [], ?int $cache_ttl = null): array
  {
    return $this->api->request(
      method: RequestTypes::POST,
      endpoint: "users/@me/channels",
      options: [
        'json' => $params
      ],
      cache_ttl: $cache_ttl
    );
  }

  public function getCurrentUserConnections(?int $cache_ttl = 600): array
  {
    return $this->api->request(
      method: RequestTypes::GET,
      endpoint: "users/@me/connections",
      cache_ttl: $cache_ttl
    );
  }

  public function getCurrentUserApplicationRoleConnection(string $application_id, ?int $cache_ttl = 600): array
  {
    return $this->api->request(
      method: RequestTypes::GET,
      endpoint: "users/@me/applications/{$application_id}/role-connection",
      cache_ttl: $cache_ttl
    );
  }

  public function updateCurrentUserApplicationRoleConnection(string $application_id, array $params = [], ?int $cache_ttl = null): array
  {
    return $this->api->request(
      method: RequestTypes::PUT,
      endpoint: "users/@me/applications/{$application_id}/role-connection",
      options: [
        'json' => $params
      ],
      cache_ttl: $cache_ttl
    );
  }
}

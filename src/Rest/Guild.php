<?php

declare(strict_types=1);

namespace Naneynonn\Rest;

use Naneynonn\Api\Client;
use Naneynonn\Enums\RequestTypes;

final class Guild
{
  private Client $api;

  public function __construct(Client $api)
  {
    $this->api = $api;
  }

  public function getGuild(string $guild_id, array $params = [], ?int $cache_ttl = 600): array
  {
    return $this->api->request(
      method: RequestTypes::GET,
      endpoint: "guilds/{$guild_id}",
      options: [
        'query' => $params
      ],
      cache_ttl: $cache_ttl
    );
  }

  public function getGuildChannels(string $guild_id, ?int $cache_ttl = 600): array
  {
    return $this->api->request(
      method: RequestTypes::GET,
      endpoint: "guilds/{$guild_id}/channels",
      cache_ttl: $cache_ttl
    );
  }

  public function getGuildRoles(string $guild_id, ?int $cache_ttl = 600): array
  {
    return $this->api->request(
      method: RequestTypes::GET,
      endpoint: "guilds/{$guild_id}/roles",
      cache_ttl: $cache_ttl
    );
  }

  public function getGuildMember(string $guild_id, string $user_id, ?int $cache_ttl = 600): array
  {
    return $this->api->request(
      method: RequestTypes::GET,
      endpoint: "guilds/{$guild_id}/members/{$user_id}",
      cache_ttl: $cache_ttl
    );
  }

  public function getGuildInvites(string $guild_id, ?int $cache_ttl = 600): array
  {
    return $this->api->request(
      method: RequestTypes::GET,
      endpoint: "guilds/{$guild_id}/invites",
      cache_ttl: $cache_ttl
    );
  }

  public function listActiveGuildThreads(string $guild_id, ?int $cache_ttl = 600): array
  {
    return $this->api->request(
      method: RequestTypes::GET,
      endpoint: "guilds/{$guild_id}/threads/active",
      cache_ttl: $cache_ttl
    );
  }

  public function addGuildMemberRole(string $guild_id, string $user_id, string $role_id, string $reason = '', ?int $cache_ttl = null): array
  {
    return $this->api->request(
      method: RequestTypes::PUT,
      endpoint: "guilds/{$guild_id}/members/{$user_id}/roles/{$role_id}",
      options: [
        'reason' => $reason
      ],
      cache_ttl: $cache_ttl
    );
  }

  public function removeGuildMemberRole(string $guild_id, string $user_id, string $role_id, string $reason = '', ?int $cache_ttl = null): array
  {
    return $this->api->request(
      method: RequestTypes::DELETE,
      endpoint: "guilds/{$guild_id}/members/{$user_id}/roles/{$role_id}",
      options: [
        'reason' => $reason
      ],
      cache_ttl: $cache_ttl
    );
  }

  public function listGuildMembers(string $guild_id, array $params = [], ?int $cache_ttl = 600): array
  {
    return $this->api->request(
      method: RequestTypes::GET,
      endpoint: "guilds/{$guild_id}/members",
      options: [
        'query' => $params
      ],
      cache_ttl: $cache_ttl
    );
  }
}

<?php

declare(strict_types=1);

namespace Naneynonn\Rest;

use Naneynonn\Api\Client;
use Naneynonn\Enums\RequestTypes;

final class Voice
{
  private Client $api;

  public function __construct(Client $api)
  {
    $this->api = $api;
  }

  public function listVoiceRegions(?int $cache_ttl = 600): array
  {
    return $this->api->request(
      method: RequestTypes::GET,
      endpoint: "voice/regions",
      cache_ttl: $cache_ttl
    );
  }

  public function getCurrentUserVoiceState(string $guild_id, ?int $cache_ttl = 600): array
  {
    return $this->api->request(
      method: RequestTypes::GET,
      endpoint: "guilds/{$guild_id}/voice-states/@me",
      cache_ttl: $cache_ttl
    );
  }

  public function getUserVoiceState(string $guild_id, string $user_id, ?int $cache_ttl = 600): array
  {
    return $this->api->request(
      method: RequestTypes::GET,
      endpoint: "guilds/{$guild_id}/voice-states/{$user_id}",
      cache_ttl: $cache_ttl
    );
  }

  public function modifyCurrentUserVoiceState(string $guild_id, array $params = [], ?int $cache_ttl = 600): array
  {
    return $this->api->request(
      method: RequestTypes::PATCH,
      endpoint: "guilds/{$guild_id}/voice-states/@me",
      options: [
        'json' => $params
      ],
      cache_ttl: $cache_ttl
    );
  }

  public function modifyUserVoiceState(string $guild_id, string $user_id, array $params = [], ?int $cache_ttl = 600): array
  {
    return $this->api->request(
      method: RequestTypes::PATCH,
      endpoint: "guilds/{$guild_id}/voice-states/{$user_id}",
      options: [
        'json' => $params
      ],
      cache_ttl: $cache_ttl
    );
  }
}

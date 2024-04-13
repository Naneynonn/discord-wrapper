<?php

declare(strict_types=1);

namespace Naneynonn\Rest;

use Naneynonn\Api\Client;
use Naneynonn\Enums\RequestTypes;

final class Emoji
{
  private Client $api;

  public function __construct(Client $api)
  {
    $this->api = $api;
  }

  public function listGuildEmojis(string $guild_id, ?int $cache_ttl = 600): array
  {
    return $this->api->request(
      method: RequestTypes::GET,
      endpoint: "guilds/{$guild_id}/emojis",
      cache_ttl: $cache_ttl
    );
  }

  public function listGuildEmoji(string $guild_id, string $emoji_id, ?int $cache_ttl = 600): array
  {
    return $this->api->request(
      method: RequestTypes::GET,
      endpoint: "guilds/{$guild_id}/emojis/{$emoji_id}",
      cache_ttl: $cache_ttl
    );
  }

  public function createGuildEmoji(string $guild_id, array $params = [], string $reason = '', ?int $cache_ttl = null): array
  {
    return $this->api->request(
      method: RequestTypes::POST,
      endpoint: "guilds/{$guild_id}/emojis",
      options: [
        'json' => $params,
        'reason' => $reason
      ],
      cache_ttl: $cache_ttl
    );
  }

  public function modifyGuildEmoji(string $guild_id, string $emoji_id, array $params = [], string $reason = '', ?int $cache_ttl = null): array
  {
    return $this->api->request(
      method: RequestTypes::PATCH,
      endpoint: "guilds/{$guild_id}/emojis/{$emoji_id}",
      options: [
        'json' => $params,
        'reason' => $reason
      ],
      cache_ttl: $cache_ttl
    );
  }

  public function deleteGuildEmoji(string $guild_id, string $emoji_id, string $reason = '', ?int $cache_ttl = null): array
  {
    return $this->api->request(
      method: RequestTypes::DELETE,
      endpoint: "guilds/{$guild_id}/emojis/{$emoji_id}",
      options: [
        'reason' => $reason
      ],
      cache_ttl: $cache_ttl
    );
  }
}

<?php

declare(strict_types=1);

namespace Naneynonn\Rest;

use Naneynonn\Api\Client;
use Naneynonn\Enums\RequestTypes;

final class Sticker
{
  private Client $api;

  public function __construct(Client $api)
  {
    $this->api = $api;
  }

  public function getSticker(string $sticker_id, ?int $cache_ttl = 600): array
  {
    return $this->api->request(
      method: RequestTypes::GET,
      endpoint: "stickers/{$sticker_id}",
      cache_ttl: $cache_ttl
    );
  }

  public function listStickerPacks(?int $cache_ttl = 600): array
  {
    return $this->api->request(
      method: RequestTypes::GET,
      endpoint: "sticker-packs",
      cache_ttl: $cache_ttl
    );
  }

  public function listGuildStickers(string $guild_id, ?int $cache_ttl = 600): array
  {
    return $this->api->request(
      method: RequestTypes::GET,
      endpoint: "guilds/{$guild_id}/stickers",
      cache_ttl: $cache_ttl
    );
  }

  public function getGuildSticker(string $guild_id, string $sticker_id, ?int $cache_ttl = 600): array
  {
    return $this->api->request(
      method: RequestTypes::GET,
      endpoint: "guilds/{$guild_id}/stickers/{$sticker_id}",
      cache_ttl: $cache_ttl
    );
  }

  public function createGuildSticker(string $guild_id, array $params = [], string $reason = '', ?int $cache_ttl = null): array
  {
    return $this->api->request(
      method: RequestTypes::POST,
      endpoint: "guilds/{$guild_id}/stickers",
      options: [
        'form_params' => $params,
        'reason' => $reason
      ],
      cache_ttl: $cache_ttl
    );
  }

  public function modifyGuildSticker(string $guild_id, string $sticker_id, array $params = [], string $reason = '', ?int $cache_ttl = null): array
  {
    return $this->api->request(
      method: RequestTypes::POST,
      endpoint: "guilds/{$guild_id}/stickers/{$sticker_id}",
      options: [
        'json' => $params,
        'reason' => $reason
      ],
      cache_ttl: $cache_ttl
    );
  }

  public function deleteGuildSticker(string $guild_id, string $sticker_id, string $reason = '', ?int $cache_ttl = null): array
  {
    return $this->api->request(
      method: RequestTypes::DELETE,
      endpoint: "guilds/{$guild_id}/stickers/{$sticker_id}",
      options: [
        'reason' => $reason
      ],
      cache_ttl: $cache_ttl
    );
  }
}

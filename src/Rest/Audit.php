<?php

declare(strict_types=1);

namespace Naneynonn\Rest;

use Naneynonn\Api\Client;
use Naneynonn\Enums\RequestTypes;

final class Audit
{
  private Client $api;

  public function __construct(Client $api)
  {
    $this->api = $api;
  }

  public function getGuildAuditLog(string $guild_id, array $params = [], ?int $cache_ttl = 600): array
  {
    return $this->api->request(
      method: RequestTypes::GET,
      endpoint: "guilds/{$guild_id}/audit-logs",
      options: [
        'query' => $params
      ],
      cache_ttl: $cache_ttl
    );
  }
}

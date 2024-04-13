<?php

declare(strict_types=1);

namespace Naneynonn\Rest;

use Naneynonn\Api\Client;
use Naneynonn\Enums\RequestTypes;

final class Invite
{
  private Client $api;

  public function __construct(Client $api)
  {
    $this->api = $api;
  }

  public function getInvite(string $code, array $params = [], ?int $cache_ttl = 600): array
  {
    return $this->api->request(
      method: RequestTypes::GET,
      endpoint: "invites/{$code}",
      options: [
        'query' => $params
      ],
      cache_ttl: $cache_ttl
    );
  }

  public function deleteInvite(string $code, string $reason = '', ?int $cache_ttl = null): array
  {
    return $this->api->request(
      method: RequestTypes::DELETE,
      endpoint: "invites/{$code}",
      options: [
        'reason' => $reason
      ],
      cache_ttl: $cache_ttl
    );
  }
}

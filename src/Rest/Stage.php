<?php

declare(strict_types=1);

namespace Naneynonn\Rest;

use Naneynonn\Api\Client;
use Naneynonn\Enums\RequestTypes;

final class Stage
{
  private Client $api;

  public function __construct(Client $api)
  {
    $this->api = $api;
  }

  public function createStageInstance(array $params = [], string $reason = '', ?int $cache_ttl = null): array
  {
    return $this->api->request(
      method: RequestTypes::POST,
      endpoint: "stage-instances",
      options: [
        'json' => $params,
        'reason' => $reason
      ],
      cache_ttl: $cache_ttl
    );
  }

  public function getStageInstance(string $channel_id, ?int $cache_ttl = 600): array
  {
    return $this->api->request(
      method: RequestTypes::GET,
      endpoint: "stage-instances/{$channel_id}",
      cache_ttl: $cache_ttl
    );
  }

  public function modifyStageInstance(string $channel_id, array $params = [], string $reason = '', ?int $cache_ttl = null): array
  {
    return $this->api->request(
      method: RequestTypes::PATCH,
      endpoint: "stage-instances/{$channel_id}",
      options: [
        'json' => $params,
        'reason' => $reason
      ],
      cache_ttl: $cache_ttl
    );
  }

  public function deleteStageInstance(string $channel_id, string $reason = '', ?int $cache_ttl = null): array
  {
    return $this->api->request(
      method: RequestTypes::DELETE,
      endpoint: "stage-instances/{$channel_id}",
      options: [
        'reason' => $reason
      ],
      cache_ttl: $cache_ttl
    );
  }
}

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
}

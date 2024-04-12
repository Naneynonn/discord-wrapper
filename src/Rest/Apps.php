<?php

declare(strict_types=1);

namespace Naneynonn\Rest;

use Naneynonn\Api\Client;
use Naneynonn\Enums\RequestTypes;

final class Apps
{
  private Client $api;

  public function __construct(Client $api)
  {
    $this->api = $api;
  }

  public function getCurrentApplication(?int $cache_ttl = 600): array
  {
    return $this->api->request(
      method: RequestTypes::GET,
      endpoint: "applications/@me",
      cache_ttl: $cache_ttl
    );
  }

  public function editCurrentApplication(array $params = [], ?int $cache_ttl = null): array
  {
    return $this->api->request(
      method: RequestTypes::PATCH,
      endpoint: "applications/@me",
      options: [
        'json' => $params
      ],
      cache_ttl: $cache_ttl
    );
  }

  public function getApplicationRoleConnectionMetadataRecords(string $application_id, ?int $cache_ttl = 600): array
  {
    return $this->api->request(
      method: RequestTypes::GET,
      endpoint: "applications/{$application_id}/role-connections/metadata",
      cache_ttl: $cache_ttl
    );
  }

  public function updateApplicationRoleConnectionMetadataRecords(string $application_id, ?int $cache_ttl = null): array
  {
    return $this->api->request(
      method: RequestTypes::PUT,
      endpoint: "applications/{$application_id}/role-connections/metadata",
      cache_ttl: $cache_ttl
    );
  }
}

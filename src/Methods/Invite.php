<?php

namespace Naneynonn\Methods;

use Naneynonn\DiscordApiClient;
use Naneynonn\Constants;

final class Invite extends Constants
{

  private DiscordApiClient $api;

  public function __construct(DiscordApiClient $api)
  {
    $this->api = $api;
  }

  public function getInvite(string $code, array $params = [], array $options = [], ?int $cache_ttl = 60)
  {
    $url = self::URL . '/invites/' . $code;

    $queryParameters = [];

    if (isset($params['with_counts']) && is_bool($params['with_counts'])) {
      $queryParameters['with_counts'] = (string) $params['with_counts'];
    }

    if (isset($params['with_expiration']) && is_bool($params['with_expiration'])) {
      $queryParameters['with_expiration'] = (string) $params['with_expiration'];
    }

    if (isset($params['guild_scheduled_event_id'])) {
      $queryParameters['guild_scheduled_event_id'] = $params['guild_scheduled_event_id'];
    }

    if (!empty($queryParameters)) {
      $url .= '?' . http_build_query($queryParameters);
    }

    return $this->api->apiRequest(url: $url, method: 'GET', options: $options, cache_ttl: $cache_ttl);
  }

  public function deleteInvite(string $code, string $reason = '', array $options = [], ?int $cache_ttl = null)
  {
    $url = self::URL . '/invites/' . $code;

    if (!empty($reason)) {
      $options[CURLOPT_HTTPHEADER][] = "X-Audit-Log-Reason: {$reason}";
    }

    return $this->api->apiRequest(url: $url, method: 'DELETE', options: $options, cache_ttl: $cache_ttl);
  }
}

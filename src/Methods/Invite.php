<?php

namespace Naneynonn\Methods;

use Naneynonn\DiscordApiClient;
use Naneynonn\Const\Constants;
use Naneynonn\RequestBuilder;

final class Invite
{
  use Constants;

  private DiscordApiClient $api;

  public function __construct(DiscordApiClient $api)
  {
    $this->api = $api;
  }

  public function getInvite(string $code, array $params = [], array $options = [], ?int $cache_ttl = 60)
  {
    $url = self::URL . '/invites/' . $code;

    $requestBuilder = new RequestBuilder();
    $url = $requestBuilder
      ->setBaseUrl($url)
      ->setDefault(name: 'with_counts', type: 'bool')
      ->setDefault(name: 'with_expiration', type: 'bool')
      ->setDefault(name: 'guild_scheduled_event_id', type: 'string')
      ->buildUrl();

    return $this->api->apiRequest(url: $url, method: 'GET', options: $options, cache_ttl: $cache_ttl);
  }

  public function deleteInvite(string $code, string $reason = '', array $options = [], ?int $cache_ttl = null)
  {
    $url = self::URL . '/invites/' . $code;

    $requestBuilder = new RequestBuilder();
    $options = $requestBuilder
      ->withAuditLogReason(reason: $reason)
      ->getOptions();

    return $this->api->apiRequest(url: $url, method: 'DELETE', options: $options, cache_ttl: $cache_ttl);
  }
}

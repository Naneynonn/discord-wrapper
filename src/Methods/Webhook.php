<?php

namespace Naneynonn\Methods;

use Naneynonn\DiscordApiClient;
use Naneynonn\Const\Constants;
use Naneynonn\RequestBuilder;

final class Webhook
{
  use Constants;

  private DiscordApiClient $api;

  public function __construct(DiscordApiClient $api)
  {
    $this->api = $api;
  }

  public function getChannelWebhooks(string $channel_id, array $options = [], ?int $cache_ttl = 60)
  {
    $url = self::URL . '/channels/' . $channel_id . '/webhooks';

    return $this->api->apiRequest(url: $url, method: 'GET', options: $options, cache_ttl: $cache_ttl);
  }
}

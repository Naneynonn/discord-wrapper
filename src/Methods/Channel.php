<?php

namespace Naneynonn\Methods;

use Naneynonn\DiscordApiClient;
use Naneynonn\Constants;

final class Channel extends Constants
{

  private DiscordApiClient $api;

  public function __construct(DiscordApiClient $api)
  {
    $this->api = $api;
  }

  public function getChannel(string $channel_id, array $options = [], ?int $cache_ttl = null)
  {
    $url = self::URL . '/channels/' . $channel_id;
    $method = "GET";
    return $this->api->apiRequest(url: $url, method: $method, options: $options, cache_ttl: $cache_ttl);
  }
}

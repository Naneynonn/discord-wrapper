<?php

namespace Naneynonn\Methods;

use Naneynonn\DiscordApiClient;
use Naneynonn\Constants;

class Guild extends Constants
{

  private DiscordApiClient $api;

  public function __construct(DiscordApiClient $api)
  {
    $this->api = $api;
  }

  public function getGuild(string $server_id, array $options = [], ?int $cache_ttl = null)
  {
    $url = self::URL . '/guilds/' . $server_id;
    $method = "GET";
    return $this->api->apiRequest(url: $url, method: $method, options: $options, cache_ttl: $cache_ttl);
  }
}

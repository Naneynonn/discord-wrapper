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

  public function getGuildChannels(string $server_id, array $options = [], ?int $cache_ttl = null)
  {
    $url = self::URL . '/guilds/' . $server_id . '/channels';
    $method = "GET";
    return $this->api->apiRequest(url: $url, method: $method, options: $options, cache_ttl: $cache_ttl);
  }

  public function getGuildRoles(string $server_id, array $options = [], ?int $cache_ttl = null)
  {
    $url = self::URL . '/guilds/' . $server_id . '/roles';
    $method = "GET";
    return $this->api->apiRequest(url: $url, method: $method, options: $options, cache_ttl: $cache_ttl);
  }

  public function getGuildMember(string $server_id, string $user_id, array $options = [], ?int $cache_ttl = null)
  {
    $url = self::URL . '/guilds/' . $server_id . '/members/' . $user_id;
    $method = "GET";
    return $this->api->apiRequest(url: $url, method: $method, options: $options, cache_ttl: $cache_ttl);
  }
}

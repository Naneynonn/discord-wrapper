<?php

namespace Naneynonn\Methods;

use Naneynonn\DiscordApiClient;
use Naneynonn\Constants;

final class Guild extends Constants
{

  private DiscordApiClient $api;

  public function __construct(DiscordApiClient $api)
  {
    $this->api = $api;
  }

  public function getGuild(string $server_id, array $options = [], ?int $cache_ttl = null)
  {
    $url = self::URL . '/guilds/' . $server_id;
    return $this->api->apiRequest(url: $url, method: 'GET', options: $options, cache_ttl: $cache_ttl);
  }

  public function getGuildChannels(string $server_id, array $options = [], ?int $cache_ttl = null)
  {
    $url = self::URL . '/guilds/' . $server_id . '/channels';
    return $this->api->apiRequest(url: $url, method: 'GET', options: $options, cache_ttl: $cache_ttl);
  }

  public function getGuildRoles(string $server_id, array $options = [], ?int $cache_ttl = null)
  {
    $url = self::URL . '/guilds/' . $server_id . '/roles';
    return $this->api->apiRequest(url: $url, method: 'GET', options: $options, cache_ttl: $cache_ttl);
  }

  public function getGuildMember(string $server_id, string $user_id, array $options = [], ?int $cache_ttl = null)
  {
    $url = self::URL . '/guilds/' . $server_id . '/members/' . $user_id;
    return $this->api->apiRequest(url: $url, method: 'GET', options: $options, cache_ttl: $cache_ttl);
  }

  public function getGuildInvites(string $server_id, array $options = [], ?int $cache_ttl = null, bool $with_counts = false)
  {
    $url = self::URL . '/guilds/' . $server_id . '/invites?with_counts=' . $with_counts;
    return $this->api->apiRequest(url: $url, method: 'GET', options: $options, cache_ttl: $cache_ttl);
  }
}

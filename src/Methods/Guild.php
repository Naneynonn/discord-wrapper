<?php

namespace Naneynonn\Methods;

use Naneynonn\DiscordApiClient;
use Naneynonn\Const\Constants;

final class Guild
{
  use Constants;

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

  public function getGuildInvites(string $guild_id, array $options = [], ?int $cache_ttl = null, array $params = [])
  {
    $url = self::URL . '/guilds/' . $guild_id . '/invites';

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

  public function listActiveGuildThreads(string $guild_id, array $options = [], ?int $cache_ttl = null)
  {
    $url = self::URL . '/guilds/' . $guild_id . '/threads/active';
    return $this->api->apiRequest(url: $url, method: 'GET', options: $options, cache_ttl: $cache_ttl);
  }
}

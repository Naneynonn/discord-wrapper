<?php

namespace Naneynonn\Methods;

use Naneynonn\DiscordApiClient;
use Naneynonn\Const\Constants;
use Naneynonn\RequestBuilder;

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

    $requestBuilder = new RequestBuilder();
    $url = $requestBuilder
      ->setBaseUrl($url)
      ->setDefault(name: 'with_counts', type: 'boolean')
      ->setDefault(name: 'with_expiration', type: 'boolean')
      ->setDefault(name: 'guild_scheduled_event_id', type: 'string')
      ->buildUrl($params);

    return $this->api->apiRequest(url: $url, method: 'GET', options: $options, cache_ttl: $cache_ttl);
  }

  public function listActiveGuildThreads(string $guild_id, array $options = [], ?int $cache_ttl = null)
  {
    $url = self::URL . '/guilds/' . $guild_id . '/threads/active';
    return $this->api->apiRequest(url: $url, method: 'GET', options: $options, cache_ttl: $cache_ttl);
  }

  public function addGuildMemberRole(string $guild_id, string $user_id, string $role_id, ?string $reason = null, array $options = [], ?int $cache_ttl = null)
  {
    $url = self::URL . '/guilds/' . $guild_id . '/members/' . $user_id  . '/roles/' . $role_id;

    $requestBuilder = new RequestBuilder();
    $options = $requestBuilder
      ->withAuditLogReason(reason: $reason)
      ->getOptions();

    return $this->api->apiRequest(url: $url, method: 'PUT', options: $options, cache_ttl: $cache_ttl, data: NULL);
  }

  public function removeGuildMemberRole(string $guild_id, string $user_id, string $role_id, ?string $reason = null, array $options = [], ?int $cache_ttl = null)
  {
    $url = self::URL . '/guilds/' . $guild_id . '/members/' . $user_id  . '/roles/' . $role_id;

    $requestBuilder = new RequestBuilder();
    $options = $requestBuilder
      ->withAuditLogReason(reason: $reason)
      ->setExternalOptions(options: $options)
      ->getOptions();

    return $this->api->apiRequest(url: $url, method: 'DELETE', options: $options, cache_ttl: $cache_ttl);
  }

  public function listGuildMembers(string $guild_id, array $options = [], ?int $cache_ttl = null, array $params = [])
  {
    $url = self::URL . '/guilds/' . $guild_id . '/members';

    $requestBuilder = new RequestBuilder();
    $url = $requestBuilder
      ->setBaseUrl($url)
      ->setDefault(name: 'limit', type: 'integer')
      ->setDefault(name: 'after', type: 'string')
      ->buildUrl($params);

    return $this->api->apiRequest(url: $url, method: 'GET', options: $options, cache_ttl: $cache_ttl);
  }
}

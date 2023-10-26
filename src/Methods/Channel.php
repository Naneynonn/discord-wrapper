<?php

namespace Naneynonn\Methods;

use Naneynonn\DiscordApiClient;
use Naneynonn\Const\Constants;
use Naneynonn\RequestBuilder;

final class Channel
{
  use Constants;

  private DiscordApiClient $api;

  public function __construct(DiscordApiClient $api)
  {
    $this->api = $api;
  }

  public function getChannel(string $channel_id, array $options = [], ?int $cache_ttl = null)
  {
    $url = self::URL . '/channels/' . $channel_id;
    return $this->api->apiRequest(url: $url, method: 'GET', options: $options, cache_ttl: $cache_ttl);
  }

  public function modifyChannel(string $channel_id, array $params = [], string $reason = '', array $options = [], ?int $cache_ttl = null)
  {
    $url = self::URL . '/channels/' . $channel_id;

    $requestBuilder = new RequestBuilder();
    $data = $requestBuilder
      ->setBaseUrl($url)
      ->setDefault(name: 'name', type: 'string')
      ->setDefault(name: 'icon', type: 'string')
      ->setDefault(name: 'type', type: 'integer')
      ->setDefault(name: 'position', type: 'integer')
      ->setDefault(name: 'topic', type: 'string')
      ->setDefault(name: 'nsfw', type: 'boolean')
      ->setDefault(name: 'rate_limit_per_user', type: 'integer')
      ->setDefault(name: 'bitrate', type: 'integer')
      ->setDefault(name: 'user_limit', type: 'integer')
      ->setDefault(name: 'permission_overwrites', type: 'array')
      ->setDefault(name: 'parent_id', type: 'string')
      ->setDefault(name: 'rtc_region', type: 'string')
      ->setDefault(name: 'video_quality_mode', type: 'integer')
      ->setDefault(name: 'default_auto_archive_duration', type: 'integer')
      ->setDefault(name: 'flags', type: 'integer')
      ->setDefault(name: 'available_tags', type: 'array')
      ->setDefault(name: 'default_reaction_emoji', type: 'array')
      ->setDefault(name: 'default_thread_rate_limit_per_user', type: 'integer')
      ->setDefault(name: 'default_sort_order', type: 'integer')
      ->setDefault(name: 'default_forum_layout', type: 'integer')
      ->validateArray($params);

    $options = $requestBuilder
      ->withAuditLogReason(reason: $reason)
      ->getOptions();

    return $this->api->apiRequest(url: $url, method: 'PATCH', options: $options, cache_ttl: $cache_ttl, data: $data, json: true);
  }

  public function getChannelMessage(string $channel_id, string $message_id, array $options = [], ?int $cache_ttl = null)
  {
    $url = self::URL . '/channels/' . $channel_id . '/messages/' . $message_id;
    return $this->api->apiRequest(url: $url, method: 'GET', options: $options, cache_ttl: $cache_ttl);
  }

  public function createChannelInvite(string $channel_id, array $params = [], string $reason = '', array $options = [], ?int $cache_ttl = null)
  {
    $url = self::URL . '/channels/' . $channel_id . '/invites';

    $requestBuilder = new RequestBuilder();
    $data = $requestBuilder
      ->setBaseUrl($url)
      ->setDefault(name: 'max_age', type: 'integer')
      ->setDefault(name: 'max_uses', type: 'integer')
      ->setDefault(name: 'temporary', type: 'boolean')
      ->setDefault(name: 'unique', type: 'boolean')
      ->setDefault(name: 'target_type', type: 'integer')
      ->setDefault(name: 'target_user_id', type: 'string')
      ->setDefault(name: 'target_application_id', type: 'string')
      ->validateArray($params);

    $options = $requestBuilder
      ->withAuditLogReason(reason: $reason)
      ->getOptions();

    return $this->api->apiRequest(url: $url, method: 'POST', options: $options, cache_ttl: $cache_ttl, data: $data, json: true);
  }
}

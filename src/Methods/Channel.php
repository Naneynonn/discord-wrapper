<?php

namespace Naneynonn\Methods;

use Naneynonn\DiscordApiClient;
use Naneynonn\Const\Constants;

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

  public function getChannelMessage(string $channel_id, string $message_id, array $options = [], ?int $cache_ttl = null)
  {
    $url = self::URL . '/channels/' . $channel_id . '/messages/' . $message_id;
    return $this->api->apiRequest(url: $url, method: 'GET', options: $options, cache_ttl: $cache_ttl);
  }
}

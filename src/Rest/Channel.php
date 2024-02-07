<?php

declare(strict_types=1);

namespace Naneynonn\Rest;

use Naneynonn\Api\Client;

final class Channel
{
  private Client $api;

  public function __construct(Client $api)
  {
    $this->api = $api;
  }

  public function getChannel(string $channel_id, ?int $cache_ttl = 600): array
  {
    return $this->api->request(method: 'GET', endpoint: "channels/{$channel_id}", cache_ttl: $cache_ttl);
  }

  public function modifyChannel(string $channel_id, array $params = [], string $reason = '', ?int $cache_ttl = null)
  {
    return $this->api->request(method: 'PATCH', endpoint: "channels/{$channel_id}", options: [
      'json' => $params,
      'reason' => $reason
    ], cache_ttl: $cache_ttl);
  }

  public function getChannelMessage(string $channel_id, string $message_id, ?int $cache_ttl = 600)
  {
    return $this->api->request(method: 'GET', endpoint: "channels/{$channel_id}/messages/{$message_id}", cache_ttl: $cache_ttl);
  }

  public function createChannelInvite(string $channel_id, array $params = [], string $reason = '', ?int $cache_ttl = null)
  {
    return $this->api->request(method: 'POST', endpoint: "channels/{$channel_id}/invites", options: [
      'json' => $params,
      'reason' => $reason
    ], cache_ttl: $cache_ttl);
  }
}

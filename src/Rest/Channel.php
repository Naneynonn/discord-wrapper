<?php

declare(strict_types=1);

namespace Naneynonn\Rest;

use Naneynonn\Api\Client;
use Naneynonn\Enums\RequestTypes;

final class Channel
{
  private Client $api;

  public function __construct(Client $api)
  {
    $this->api = $api;
  }

  public function getChannel(string $channel_id, ?int $cache_ttl = 600): array
  {
    return $this->api->request(
      method: RequestTypes::GET,
      endpoint: "channels/{$channel_id}",
      cache_ttl: $cache_ttl
    );
  }

  public function modifyChannel(string $channel_id, array $params = [], string $reason = '', ?int $cache_ttl = null)
  {
    return $this->api->request(
      method: RequestTypes::PATCH,
      endpoint: "channels/{$channel_id}",
      options: [
        'json' => $params,
        'reason' => $reason
      ],
      cache_ttl: $cache_ttl
    );
  }

  public function deleteChannel(string $channel_id, string $reason = '', ?int $cache_ttl = null): array
  {
    return $this->api->request(
      method: RequestTypes::DELETE,
      endpoint: "channels/{$channel_id}",
      options: [
        'reason' => $reason
      ],
      cache_ttl: $cache_ttl
    );
  }

  public function closeChannel(string $channel_id, string $reason = '', ?int $cache_ttl = null): array
  {
    return $this->deleteChannel(channel_id: $channel_id, reason: $reason, cache_ttl: $cache_ttl);
  }

  public function getChannelMessages(string $channel_id, array $params = [], ?int $cache_ttl = 600)
  {
    return $this->api->request(
      method: RequestTypes::GET,
      options: [
        'query' => $params
      ],
      endpoint: "channels/{$channel_id}/messages",
      cache_ttl: $cache_ttl
    );
  }

  public function getChannelMessage(string $channel_id, string $message_id, ?int $cache_ttl = 600)
  {
    return $this->api->request(
      method: RequestTypes::GET,
      endpoint: "channels/{$channel_id}/messages/{$message_id}",
      cache_ttl: $cache_ttl
    );
  }

  public function createMessage(string $channel_id, array $params = [], string $reason = '', ?int $cache_ttl = null)
  {
    return $this->api->request(
      method: RequestTypes::POST,
      endpoint: "channels/{$channel_id}/messages",
      options: [
        'json' => $params,
        'reason' => $reason
      ],
      cache_ttl: $cache_ttl
    );
  }

  public function crosspostMessage(string $channel_id, string $message_id, array $params = [], ?int $cache_ttl = null)
  {
    return $this->api->request(
      method: RequestTypes::POST,
      endpoint: "channels/{$channel_id}/messages/{$message_id}/crosspost",
      options: [
        'json' => $params
      ],
      cache_ttl: $cache_ttl
    );
  }

  public function createChannelInvite(string $channel_id, array $params = [], string $reason = '', ?int $cache_ttl = null)
  {
    return $this->api->request(
      method: RequestTypes::POST,
      endpoint: "channels/{$channel_id}/invites",
      options: [
        'json' => $params,
        'reason' => $reason
      ],
      cache_ttl: $cache_ttl
    );
  }
}

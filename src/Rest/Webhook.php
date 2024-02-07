<?php

declare(strict_types=1);

namespace Naneynonn\Rest;

use Naneynonn\Api\Client;

use function Naneynonn\Functions\getDecodeImage;

final class Webhook
{
  private Client $api;

  public function __construct(Client $api)
  {
    $this->api = $api;
  }

  public function getChannelWebhooks(string $channel_id, array $params = [], ?int $cache_ttl = 600): array
  {
    return $this->api->request(method: 'GET', endpoint: "channels/{$channel_id}/webhooks", options: [
      'query' => $params
    ], cache_ttl: $cache_ttl);
  }

  public function createWebhook(string $channel_id, array $params = [], string $reason = '', ?int $cache_ttl = null): array
  {
    if (!empty($params['avatar'])) {
      $params['avatar'] = getDecodeImage(url: $params['avatar']);
    }

    return $this->api->request(method: 'POST', endpoint: "channels/{$channel_id}/webhooks", options: [
      'json' => $params,
      'reason' => $reason
    ], cache_ttl: $cache_ttl);
  }
}

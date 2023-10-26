<?php

namespace Naneynonn\Methods;

use Naneynonn\DiscordApiClient;
use Naneynonn\Const\Constants;
use Naneynonn\RequestBuilder;

use function Naneynonn\getDecodeImage;

final class Webhook
{
  use Constants;

  private DiscordApiClient $api;

  public function __construct(DiscordApiClient $api)
  {
    $this->api = $api;
  }

  public function getChannelWebhooks(string $channel_id, array $options = [], ?int $cache_ttl = 60)
  {
    $url = self::URL . '/channels/' . $channel_id . '/webhooks';

    return $this->api->apiRequest(url: $url, method: 'GET', options: $options, cache_ttl: $cache_ttl);
  }

  public function createWebhook(string $channel_id, array $params = [], string $reason = '', array $options = [], ?int $cache_ttl = null)
  {
    $url = self::URL . '/channels/' . $channel_id . '/webhooks';

    if (!empty($params['avatar'])) {
      $params['avatar'] = getDecodeImage(url: $params['avatar']);
    }

    $requestBuilder = new RequestBuilder();
    $data = $requestBuilder
      ->setBaseUrl($url)
      ->setDefault(name: 'name', type: 'string')
      ->setDefault(name: 'avatar', type: 'string')
      ->validateArray($params);

    $options = $requestBuilder
      ->withAuditLogReason(reason: $reason)
      ->getOptions();

    var_dump($data);

    return $this->api->apiRequest(url: $url, method: 'POST', options: $options, cache_ttl: $cache_ttl, data: $data, json: true);
  }
}

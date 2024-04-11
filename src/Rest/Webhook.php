<?php

declare(strict_types=1);

namespace Naneynonn\Rest;

use Naneynonn\Api\Client;
use Naneynonn\Enums\RequestTypes;

use function Naneynonn\Functions\getDecodeImage;

final class Webhook
{
  private Client $api;

  public function __construct(Client $api)
  {
    $this->api = $api;
  }

  public function createWebhook(string $channel_id, array $params = [], string $reason = '', ?int $cache_ttl = null): array
  {
    if (!empty($params['avatar'])) {
      $params['avatar'] = getDecodeImage(url: $params['avatar']);
    }

    return $this->api->request(
      method: RequestTypes::POST,
      endpoint: "channels/{$channel_id}/webhooks",
      options: [
        'json' => $params,
        'reason' => $reason
      ],
      cache_ttl: $cache_ttl
    );
  }

  public function getChannelWebhooks(string $channel_id, ?int $cache_ttl = 600): array
  {
    return $this->api->request(
      method: RequestTypes::GET,
      endpoint: "channels/{$channel_id}/webhooks",
      cache_ttl: $cache_ttl
    );
  }

  public function getGuildWebhooks(string $guild_id, ?int $cache_ttl = 600): array
  {
    return $this->api->request(
      method: RequestTypes::GET,
      endpoint: "guilds/{$guild_id}/webhooks",
      cache_ttl: $cache_ttl
    );
  }

  public function getWebhook(string $webhook_id, ?int $cache_ttl = 600): array
  {
    return $this->api->request(
      method: RequestTypes::GET,
      endpoint: "webhooks/{$webhook_id}",
      cache_ttl: $cache_ttl
    );
  }

  public function getWebhookWithToken(string $webhook_id, string $webhook_token, ?int $cache_ttl = 600): array
  {
    return $this->api->request(
      method: RequestTypes::GET,
      endpoint: "webhooks/{$webhook_id}/{$webhook_token}",
      cache_ttl: $cache_ttl
    );
  }

  public function modifyWebhook(string $webhook_id, array $params = [], string $reason = '', ?int $cache_ttl = null): array
  {
    return $this->api->request(
      method: RequestTypes::PATCH,
      endpoint: "webhooks/{$webhook_id}",
      options: [
        'json' => $params,
        'reason' => $reason
      ],
      cache_ttl: $cache_ttl
    );
  }

  public function modifyWebhookWithToken(string $webhook_id, string $webhook_token, array $params = [], string $reason = '', ?int $cache_ttl = null): array
  {
    return $this->api->request(
      method: RequestTypes::PATCH,
      endpoint: "webhooks/{$webhook_id}/{$webhook_token}",
      options: [
        'json' => $params,
        'reason' => $reason
      ],
      cache_ttl: $cache_ttl
    );
  }

  public function deleteWebhook(string $webhook_id, string $reason = '', ?int $cache_ttl = null): array
  {
    return $this->api->request(
      method: RequestTypes::DELETE,
      endpoint: "webhooks/{$webhook_id}",
      options: [
        'reason' => $reason
      ],
      cache_ttl: $cache_ttl
    );
  }

  public function deleteWebhookWithToken(string $webhook_id, string $webhook_token, string $reason = '', ?int $cache_ttl = null): array
  {
    return $this->api->request(
      method: RequestTypes::DELETE,
      endpoint: "webhooks/{$webhook_id}/{$webhook_token}",
      options: [
        'reason' => $reason
      ],
      cache_ttl: $cache_ttl
    );
  }

  public function executeWebhook(string $webhook_id, string $webhook_token, array $params = [], ?int $cache_ttl = null): array
  {
    return $this->api->request(
      method: RequestTypes::POST,
      endpoint: "webhooks/{$webhook_id}/{$webhook_token}",
      options: [
        'query' => $params['query'] ?? [],
        'json' => $params
      ],
      cache_ttl: $cache_ttl
    );
  }

  public function executeSlackCompatibleWebhook(string $webhook_id, string $webhook_token, array $params = [], ?int $cache_ttl = null): array
  {
    return $this->api->request(
      method: RequestTypes::POST,
      endpoint: "webhooks/{$webhook_id}/{$webhook_token}/slack",
      options: [
        'query' => $params
      ],
      cache_ttl: $cache_ttl
    );
  }

  public function executeGitHubCompatibleWebhook(string $webhook_id, string $webhook_token, array $params = [], ?int $cache_ttl = null): array
  {
    return $this->api->request(
      method: RequestTypes::POST,
      endpoint: "webhooks/{$webhook_id}/{$webhook_token}/github",
      options: [
        'query' => $params
      ],
      cache_ttl: $cache_ttl
    );
  }

  public function getWebhookMessage(string $webhook_id, string $webhook_token, string $message_id, array $params = [], ?int $cache_ttl = null): array
  {
    return $this->api->request(
      method: RequestTypes::GET,
      endpoint: "webhooks/{$webhook_id}/{$webhook_token}/messages/{$message_id}",
      options: [
        'query' => $params
      ],
      cache_ttl: $cache_ttl
    );
  }

  public function editWebhookMessage(string $webhook_id, string $webhook_token, string $message_id, array $params = [], ?int $cache_ttl = null): array
  {
    return $this->api->request(
      method: RequestTypes::PATCH,
      endpoint: "webhooks/{$webhook_id}/{$webhook_token}/messages/{$message_id}",
      options: [
        'query' => $params['query'] ?? [],
        'json' => $params
      ],
      cache_ttl: $cache_ttl
    );
  }
}

<?php

declare(strict_types=1);

namespace Naneynonn\Webhook;

use Naneynonn\Http\HttpClient;
use Naneynonn\Enums\RequestTypes;

use InvalidArgumentException;
use JsonException;

final class WebhookClient
{
  private HttpClient $http;
  private string $webhookId;
  private string $webhookToken;

  /**
   * @param string $url Full webhook URL:
   *   https://discord.com/api/webhooks/{id}/{token}
   */
  public function __construct(string $url, ?array $proxy = null, bool $retry = true)
  {
    $parsed = self::parseWebhookUrl($url);
    $this->webhookId = $parsed['id'];
    $this->webhookToken = $parsed['token'];

    $this->http = new HttpClient(proxy: $proxy, retry: $retry);
  }

  /**
   * Send a message to the webhook.
   *
   * @param WebhookMessage|array $message
   * @param bool $wait  Wait for message object in response
   * @return array Discord message object (if wait=true), or empty
   */
  // public function send(WebhookMessage|array $message, bool $wait = false): array
  // {
  //   $payload = $message instanceof WebhookMessage ? $message->toArray() : $message;
  //   $endpoint = "webhooks/{$this->webhookId}/{$this->webhookToken}";

  //   $options = [
  //     'headers' => ['Content-Type' => 'application/json'],
  //     'json'    => $payload,
  //   ];

  //   if ($wait) {
  //     $options['query'] = ['wait' => 'true'];
  //   }

  //   return $this->decode(
  //     $this->http->send(method: RequestTypes::POST, url: $endpoint, options: $options)
  //   );
  // }
  public function send(WebhookMessage|array $message, bool $wait = false): array
  {
    $payload = $message instanceof WebhookMessage ? $message->toArray() : $message;
    $endpoint = "webhooks/{$this->webhookId}/{$this->webhookToken}";

    $query = [];
    if ($wait) {
      $query['wait'] = 'true';
    }

    // Components V2 и обычные компоненты требуют этот параметр
    // для не-application вебхуков
    if (!empty($payload['components'])) {
      $query['with_components'] = 'true';
    }

    $options = [
      'headers' => ['Content-Type' => 'application/json'],
      'json'    => $payload,
    ];

    if (!empty($query)) {
      $options['query'] = $query;
    }

    return $this->decode(
      $this->http->send(method: RequestTypes::POST, url: $endpoint, options: $options)
    );
  }

  // public function edit(string $messageId, WebhookMessage|array $message): array
  // {
  //   $payload = $message instanceof WebhookMessage ? $message->toArray() : $message;
  //   $endpoint = "webhooks/{$this->webhookId}/{$this->webhookToken}/messages/{$messageId}";

  //   return $this->decode(
  //     $this->http->send(
  //       method: RequestTypes::PATCH,
  //       url: $endpoint,
  //       options: [
  //         'headers' => ['Content-Type' => 'application/json'],
  //         'json'    => $payload,
  //       ]
  //     )
  //   );
  // }
  public function edit(string $messageId, WebhookMessage|array $message): array
  {
    $payload = $message instanceof WebhookMessage ? $message->toArray() : $message;
    $endpoint = "webhooks/{$this->webhookId}/{$this->webhookToken}/messages/{$messageId}";

    $options = [
      'headers' => ['Content-Type' => 'application/json'],
      'json'    => $payload,
    ];

    if (!empty($payload['components'])) {
      $options['query'] = ['with_components' => 'true'];
    }

    return $this->decode(
      $this->http->send(method: RequestTypes::PATCH, url: $endpoint, options: $options)
    );
  }

  public function delete(string $messageId): void
  {
    $endpoint = "webhooks/{$this->webhookId}/{$this->webhookToken}/messages/{$messageId}";
    $this->http->send(method: RequestTypes::DELETE, url: $endpoint);
  }

  public function get(string $messageId): array
  {
    $endpoint = "webhooks/{$this->webhookId}/{$this->webhookToken}/messages/{$messageId}";

    return $this->decode(
      $this->http->send(method: RequestTypes::GET, url: $endpoint)
    );
  }

  private function decode(string $body): array
  {
    if ($body === '' || $body === '{}') return [];

    try {
      return json_decode($body, true, 512, JSON_THROW_ON_ERROR) ?? [];
    } catch (JsonException) {
      return [];
    }
  }

  private static function parseWebhookUrl(string $url): array
  {
    // Supports:
    //   https://discord.com/api/webhooks/{id}/{token}
    //   https://discordapp.com/api/webhooks/{id}/{token}
    //   https://canary.discord.com/api/webhooks/{id}/{token}
    if (preg_match('#webhooks/(\d+)/([a-zA-Z0-9_-]+)#', $url, $m)) {
      return ['id' => $m[1], 'token' => $m[2]];
    }

    throw new InvalidArgumentException(
      'Invalid webhook URL. Expected: https://discord.com/api/webhooks/{id}/{token}'
    );
  }
}

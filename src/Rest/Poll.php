<?php

declare(strict_types=1);

namespace Naneynonn\Rest;

use Naneynonn\Api\Client;
use Naneynonn\Enums\RequestTypes;

final class Poll
{
  private Client $api;

  public function __construct(Client $api)
  {
    $this->api = $api;
  }

  public function getAnswerVoters(string $channel_id, string $message_id, string $answer_id, ?int $cache_ttl = 600): array
  {
    return $this->api->request(
      method: RequestTypes::GET,
      endpoint: "channels/{$channel_id}/polls/{$message_id}/answers/{$answer_id}",
      cache_ttl: $cache_ttl
    );
  }

  public function endPoll(string $channel_id, string $message_id, ?int $cache_ttl = 600): array
  {
    return $this->api->request(
      method: RequestTypes::POST,
      endpoint: "channels/{$channel_id}/polls/{$message_id}/expire",
      cache_ttl: $cache_ttl
    );
  }
}

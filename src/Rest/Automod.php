<?php

declare(strict_types=1);

namespace Naneynonn\Rest;

use Naneynonn\Api\Client;
use Naneynonn\Enums\RequestTypes;

final class Automod
{
  private Client $api;

  public function __construct(Client $api)
  {
    $this->api = $api;
  }

  public function listAutoModerationRulesForGuild(string $guild_id, ?int $cache_ttl = 600): array
  {
    return $this->api->request(
      method: RequestTypes::GET,
      endpoint: "guilds/{$guild_id}/auto-moderation/rules",
      cache_ttl: $cache_ttl
    );
  }

  public function getAutoModerationRule(string $guild_id, string $rule_id, ?int $cache_ttl = 600): array
  {
    return $this->api->request(
      method: RequestTypes::GET,
      endpoint: "guilds/{$guild_id}/auto-moderation/rules/{$rule_id}",
      cache_ttl: $cache_ttl
    );
  }

  public function createAutoModerationRule(string $guild_id, array $params = [], string $reason = '', ?int $cache_ttl = null): array
  {
    return $this->api->request(
      method: RequestTypes::POST,
      endpoint: "guilds/{$guild_id}/auto-moderation/rules",
      options: [
        'json' => $params,
        'reason' => $reason
      ],
      cache_ttl: $cache_ttl
    );
  }

  public function modifyAutoModerationRule(string $guild_id, string $rule_id, array $params = [], string $reason = '', ?int $cache_ttl = null): array
  {
    return $this->api->request(
      method: RequestTypes::PATCH,
      endpoint: "guilds/{$guild_id}/auto-moderation/rules/{$rule_id}",
      options: [
        'json' => $params,
        'reason' => $reason
      ],
      cache_ttl: $cache_ttl
    );
  }

  public function deleteAutoModerationRule(string $guild_id, string $rule_id, string $reason = '', ?int $cache_ttl = null): array
  {
    return $this->api->request(
      method: RequestTypes::DELETE,
      endpoint: "guilds/{$guild_id}/auto-moderation/rules/{$rule_id}",
      options: [
        'reason' => $reason
      ],
      cache_ttl: $cache_ttl
    );
  }
}

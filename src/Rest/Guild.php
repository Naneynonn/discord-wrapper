<?php

declare(strict_types=1);

namespace Naneynonn\Rest;

use Naneynonn\Api\Client;
use Naneynonn\Enums\RequestTypes;

final class Guild
{
  private Client $api;

  public function __construct(Client $api)
  {
    $this->api = $api;
  }

  public function createGuild(array $params = [])
  {
    return $this->api->request(
      method: RequestTypes::POST,
      endpoint: "guilds",
      options: [
        'json' => $params
      ]
    );
  }

  public function getGuild(string $guild_id, array $params = [], ?int $cache_ttl = 600): array
  {
    return $this->api->request(
      method: RequestTypes::GET,
      endpoint: "guilds/{$guild_id}",
      options: [
        'query' => $params
      ],
      cache_ttl: $cache_ttl
    );
  }

  public function getGuildPreview(string $guild_id, ?int $cache_ttl = 600): array
  {
    return $this->api->request(
      method: RequestTypes::GET,
      endpoint: "guilds/{$guild_id}/preview",
      cache_ttl: $cache_ttl
    );
  }

  public function modifyGuild(string $guild_id, array $params = [], string $reason = '', ?int $cache_ttl = null): array
  {
    return $this->api->request(
      method: RequestTypes::PATCH,
      endpoint: "guilds/{$guild_id}",
      options: [
        'json' => $params,
        'reason' => $reason
      ],
      cache_ttl: $cache_ttl
    );
  }

  public function deleteGuild(string $guild_id): array
  {
    return $this->api->request(
      method: RequestTypes::DELETE,
      endpoint: "guilds/{$guild_id}"
    );
  }

  public function getGuildChannels(string $guild_id, ?int $cache_ttl = 600): array
  {
    return $this->api->request(
      method: RequestTypes::GET,
      endpoint: "guilds/{$guild_id}/channels",
      cache_ttl: $cache_ttl
    );
  }

  public function createGuildChannel(string $guild_id, array $params = [], string $reason = '', ?int $cache_ttl = 600): array
  {
    return $this->api->request(
      method: RequestTypes::POST,
      endpoint: "guilds/{$guild_id}/channels",
      options: [
        'json' => $params,
        'reason' => $reason
      ],
      cache_ttl: $cache_ttl
    );
  }

  public function modifyGuildChannelPositions(string $guild_id, array $params = [], ?int $cache_ttl = 600): array
  {
    return $this->api->request(
      method: RequestTypes::PATCH,
      endpoint: "guilds/{$guild_id}/channels",
      options: [
        'json' => $params
      ],
      cache_ttl: $cache_ttl
    );
  }

  public function listActiveGuildThreads(string $guild_id, ?int $cache_ttl = 600): array
  {
    return $this->api->request(
      method: RequestTypes::GET,
      endpoint: "guilds/{$guild_id}/threads/active",
      cache_ttl: $cache_ttl
    );
  }

  public function getGuildMember(string $guild_id, string $user_id, ?int $cache_ttl = 600): array
  {
    return $this->api->request(
      method: RequestTypes::GET,
      endpoint: "guilds/{$guild_id}/members/{$user_id}",
      cache_ttl: $cache_ttl
    );
  }

  public function listGuildMembers(string $guild_id, array $params = [], ?int $cache_ttl = 600): array
  {
    return $this->api->request(
      method: RequestTypes::GET,
      endpoint: "guilds/{$guild_id}/members",
      options: [
        'query' => $params
      ],
      cache_ttl: $cache_ttl
    );
  }

  public function searchGuildMembers(string $guild_id, array $params = [], ?int $cache_ttl = 600): array
  {
    return $this->api->request(
      method: RequestTypes::GET,
      endpoint: "guilds/{$guild_id}/members/search",
      options: [
        'query' => $params
      ],
      cache_ttl: $cache_ttl
    );
  }

  public function addGuildMember(string $guild_id, string $user_id, array $params = [], ?int $cache_ttl = null): array
  {
    return $this->api->request(
      method: RequestTypes::PUT,
      endpoint: "guilds/{$guild_id}/members/{$user_id}",
      options: [
        'json' => $params
      ],
      cache_ttl: $cache_ttl
    );
  }

  public function modifyGuildMember(string $guild_id, string $user_id, array $params = [], string $reason = '', ?int $cache_ttl = null): array
  {
    return $this->api->request(
      method: RequestTypes::PATCH,
      endpoint: "guilds/{$guild_id}/members/{$user_id}",
      options: [
        'json' => $params,
        'reason' => $reason
      ],
      cache_ttl: $cache_ttl
    );
  }

  public function modifyCurrentMember(string $guild_id, array $params = [], string $reason = '', ?int $cache_ttl = null): array
  {
    return $this->api->request(
      method: RequestTypes::PATCH,
      endpoint: "guilds/{$guild_id}/members/@me",
      options: [
        'json' => $params,
        'reason' => $reason
      ],
      cache_ttl: $cache_ttl
    );
  }

  public function addGuildMemberRole(string $guild_id, string $user_id, string $role_id, string $reason = '', ?int $cache_ttl = null): array
  {
    return $this->api->request(
      method: RequestTypes::PUT,
      endpoint: "guilds/{$guild_id}/members/{$user_id}/roles/{$role_id}",
      options: [
        'reason' => $reason
      ],
      cache_ttl: $cache_ttl
    );
  }

  public function removeGuildMemberRole(string $guild_id, string $user_id, string $role_id, string $reason = '', ?int $cache_ttl = null): array
  {
    return $this->api->request(
      method: RequestTypes::DELETE,
      endpoint: "guilds/{$guild_id}/members/{$user_id}/roles/{$role_id}",
      options: [
        'reason' => $reason
      ],
      cache_ttl: $cache_ttl
    );
  }

  public function removeGuildMember(string $guild_id, string $user_id, string $reason = '', ?int $cache_ttl = null): array
  {
    return $this->api->request(
      method: RequestTypes::DELETE,
      endpoint: "guilds/{$guild_id}/members/{$user_id}",
      options: [
        'reason' => $reason
      ],
      cache_ttl: $cache_ttl
    );
  }

  public function getGuildBans(string $guild_id, array $params = [], ?int $cache_ttl = 600): array
  {
    return $this->api->request(
      method: RequestTypes::GET,
      endpoint: "guilds/{$guild_id}/bans",
      options: [
        'query' => $params
      ],
      cache_ttl: $cache_ttl
    );
  }

  public function getGuildBan(string $guild_id, string $user_id, ?int $cache_ttl = 600): array
  {
    return $this->api->request(
      method: RequestTypes::GET,
      endpoint: "guilds/{$guild_id}/bans/{$user_id}",
      cache_ttl: $cache_ttl
    );
  }

  public function createGuildBan(string $guild_id, string $user_id, array $params = [], string $reason = '', ?int $cache_ttl = null): array
  {
    return $this->api->request(
      method: RequestTypes::PUT,
      endpoint: "guilds/{$guild_id}/bans/{$user_id}",
      options: [
        'json' => $params,
        'reason' => $reason
      ],
      cache_ttl: $cache_ttl
    );
  }

  public function removeGuildBan(string $guild_id, string $user_id, string $reason = '', ?int $cache_ttl = null): array
  {
    return $this->api->request(
      method: RequestTypes::DELETE,
      endpoint: "guilds/{$guild_id}/bans/{$user_id}",
      options: [
        'reason' => $reason
      ],
      cache_ttl: $cache_ttl
    );
  }

  public function bulkGuildBan(string $guild_id, array $params = [], string $reason = '', ?int $cache_ttl = null): array
  {
    return $this->api->request(
      method: RequestTypes::POST,
      endpoint: "guilds/{$guild_id}/bulk-ban",
      options: [
        'json' => $params,
        'reason' => $reason
      ],
      cache_ttl: $cache_ttl
    );
  }

  public function getGuildRoles(string $guild_id, ?int $cache_ttl = 600): array
  {
    return $this->api->request(
      method: RequestTypes::GET,
      endpoint: "guilds/{$guild_id}/roles",
      cache_ttl: $cache_ttl
    );
  }

  public function createGuildRole(string $guild_id, array $params = [], string $reason = '', ?int $cache_ttl = null): array
  {
    return $this->api->request(
      method: RequestTypes::POST,
      endpoint: "guilds/{$guild_id}/roles",
      options: [
        'json' => $params,
        'reason' => $reason
      ],
      cache_ttl: $cache_ttl
    );
  }

  public function modifyGuildRolePositions(string $guild_id, array $params = [], string $reason = '', ?int $cache_ttl = null): array
  {
    return $this->api->request(
      method: RequestTypes::PATCH,
      endpoint: "guilds/{$guild_id}/roles",
      options: [
        'json' => $params,
        'reason' => $reason
      ],
      cache_ttl: $cache_ttl
    );
  }

  public function modifyGuildRole(string $guild_id, string $role_id, array $params = [], string $reason = '', ?int $cache_ttl = null): array
  {
    return $this->api->request(
      method: RequestTypes::PATCH,
      endpoint: "guilds/{$guild_id}/roles/{$role_id}",
      options: [
        'json' => $params,
        'reason' => $reason
      ],
      cache_ttl: $cache_ttl
    );
  }

  public function modifyGuildMFALevel(string $guild_id, array $params = [], string $reason = '', ?int $cache_ttl = null): array
  {
    return $this->api->request(
      method: RequestTypes::POST,
      endpoint: "guilds/{$guild_id}/mfa",
      options: [
        'json' => $params,
        'reason' => $reason
      ],
      cache_ttl: $cache_ttl
    );
  }

  public function deleteGuildRole(string $guild_id, string $role_id, string $reason = '', ?int $cache_ttl = null): array
  {
    return $this->api->request(
      method: RequestTypes::DELETE,
      endpoint: "guilds/{$guild_id}/roles/{$role_id}",
      options: [
        'reason' => $reason
      ],
      cache_ttl: $cache_ttl
    );
  }

  public function getGuildPruneCount(string $guild_id, array $params = [], ?int $cache_ttl = 600): array
  {
    return $this->api->request(
      method: RequestTypes::GET,
      endpoint: "guilds/{$guild_id}/prune",
      options: [
        'query' => $params
      ],
      cache_ttl: $cache_ttl
    );
  }

  public function beginGuildPrune(string $guild_id, array $params = [], string $reason = '', ?int $cache_ttl = null): array
  {
    return $this->api->request(
      method: RequestTypes::POST,
      endpoint: "guilds/{$guild_id}/prune",
      options: [
        'json' => $params,
        'reason' => $reason
      ],
      cache_ttl: $cache_ttl
    );
  }

  public function getGuildVoiceRegions(string $guild_id, ?int $cache_ttl = 600): array
  {
    return $this->api->request(
      method: RequestTypes::GET,
      endpoint: "guilds/{$guild_id}/regions",
      cache_ttl: $cache_ttl
    );
  }

  public function getGuildInvites(string $guild_id, ?int $cache_ttl = 600): array
  {
    return $this->api->request(
      method: RequestTypes::GET,
      endpoint: "guilds/{$guild_id}/invites",
      cache_ttl: $cache_ttl
    );
  }

  public function getGuildIntegrations(string $guild_id, ?int $cache_ttl = 600): array
  {
    return $this->api->request(
      method: RequestTypes::GET,
      endpoint: "guilds/{$guild_id}/integrations",
      cache_ttl: $cache_ttl
    );
  }

  public function deleteGuildIntegration(string $guild_id, string $integration_id, string $reason = '', ?int $cache_ttl = null): array
  {
    return $this->api->request(
      method: RequestTypes::DELETE,
      endpoint: "guilds/{$guild_id}/integrations/{$integration_id}",
      options: [
        'reason' => $reason
      ],
      cache_ttl: $cache_ttl
    );
  }

  public function getGuildWidgetSettings(string $guild_id, ?int $cache_ttl = 600): array
  {
    return $this->api->request(
      method: RequestTypes::GET,
      endpoint: "guilds/{$guild_id}/widget",
      cache_ttl: $cache_ttl
    );
  }

  public function modifyGuildWidget(string $guild_id, string $reason = '', ?int $cache_ttl = null): array
  {
    return $this->api->request(
      method: RequestTypes::PATCH,
      endpoint: "guilds/{$guild_id}/widget",
      options: [
        'reason' => $reason
      ],
      cache_ttl: $cache_ttl
    );
  }

  public function getGuildWidget(string $guild_id, ?int $cache_ttl = 600): array
  {
    return $this->api->request(
      method: RequestTypes::GET,
      endpoint: "guilds/{$guild_id}/widget.json",
      cache_ttl: $cache_ttl
    );
  }

  public function getGuildVanityURL(string $guild_id, ?int $cache_ttl = 600): array
  {
    return $this->api->request(
      method: RequestTypes::GET,
      endpoint: "guilds/{$guild_id}/vanity-url",
      cache_ttl: $cache_ttl
    );
  }

  public function getGuildWidgetImage(string $guild_id, array $params = [], ?int $cache_ttl = 600): array
  {
    return $this->api->request(
      method: RequestTypes::GET,
      endpoint: "guilds/{$guild_id}/widget.png",
      options: [
        'query' => $params
      ],
      cache_ttl: $cache_ttl
    );
  }

  public function getGuildWelcomeScreen(string $guild_id, ?int $cache_ttl = 600): array
  {
    return $this->api->request(
      method: RequestTypes::GET,
      endpoint: "guilds/{$guild_id}/welcome-screen",
      cache_ttl: $cache_ttl
    );
  }

  public function modifyGuildWelcomeScreen(string $guild_id, array $params = [], string $reason = '', ?int $cache_ttl = null): array
  {
    return $this->api->request(
      method: RequestTypes::PATCH,
      endpoint: "guilds/{$guild_id}/welcome-screen",
      options: [
        'json' => $params,
        'reason' => $reason
      ],
      cache_ttl: $cache_ttl
    );
  }

  public function getGuildOnboarding(string $guild_id, ?int $cache_ttl = 600): array
  {
    return $this->api->request(
      method: RequestTypes::GET,
      endpoint: "guilds/{$guild_id}/onboarding",
      cache_ttl: $cache_ttl
    );
  }

  public function modifyGuildOnboarding(string $guild_id, array $params = [], string $reason = '', ?int $cache_ttl = null): array
  {
    return $this->api->request(
      method: RequestTypes::PUT,
      endpoint: "guilds/{$guild_id}/onboarding",
      options: [
        'json' => $params,
        'reason' => $reason
      ],
      cache_ttl: $cache_ttl
    );
  }

  public function modifyCurrentUserVoiceState(string $guild_id, array $params = [], ?int $cache_ttl = null): array
  {
    return $this->api->request(
      method: RequestTypes::PATCH,
      endpoint: "guilds/{$guild_id}/voice-states/@me",
      options: [
        'json' => $params
      ],
      cache_ttl: $cache_ttl
    );
  }

  public function modifyUserVoiceState(string $guild_id, string $user_id, array $params = [], ?int $cache_ttl = null): array
  {
    return $this->api->request(
      method: RequestTypes::PATCH,
      endpoint: "guilds/{$guild_id}/voice-states/{$user_id}",
      options: [
        'json' => $params
      ],
      cache_ttl: $cache_ttl
    );
  }

  public function listScheduledEventsForGuild(string $guild_id, array $params = [], ?int $cache_ttl = 600): array
  {
    return $this->api->request(
      method: RequestTypes::GET,
      endpoint: "guilds/{$guild_id}/scheduled-events",
      options: [
        'query' => $params
      ],
      cache_ttl: $cache_ttl
    );
  }

  public function createGuildScheduledEvent(string $guild_id, array $params = [], string $reason = '', ?int $cache_ttl = null): array
  {
    return $this->api->request(
      method: RequestTypes::POST,
      endpoint: "guilds/{$guild_id}/scheduled-events",
      options: [
        'json' => $params,
        'reason' => $reason
      ],
      cache_ttl: $cache_ttl
    );
  }

  public function getGuildScheduledEvent(string $guild_id, string $event_id, array $params = [], ?int $cache_ttl = 600): array
  {
    return $this->api->request(
      method: RequestTypes::GET,
      endpoint: "guilds/{$guild_id}/scheduled-events/{$event_id}",
      options: [
        'query' => $params
      ],
      cache_ttl: $cache_ttl
    );
  }

  public function modifyGuildScheduledEvent(string $guild_id, string $event_id, array $params = [], string $reason = '', ?int $cache_ttl = null): array
  {
    return $this->api->request(
      method: RequestTypes::PATCH,
      endpoint: "guilds/{$guild_id}/scheduled-events/{$event_id}",
      options: [
        'json' => $params,
        'reason' => $reason
      ],
      cache_ttl: $cache_ttl
    );
  }

  public function deleteGuildScheduledEvent(string $guild_id, string $event_id, ?int $cache_ttl = null): array
  {
    return $this->api->request(
      method: RequestTypes::DELETE,
      endpoint: "guilds/{$guild_id}/scheduled-events/{$event_id}",
      cache_ttl: $cache_ttl
    );
  }

  public function getGuildScheduledEventUsers(string $guild_id, string $event_id, array $params = [], ?int $cache_ttl = 600): array
  {
    return $this->api->request(
      method: RequestTypes::GET,
      endpoint: "guilds/{$guild_id}/scheduled-events/{$event_id}/users",
      options: [
        'query' => $params
      ],
      cache_ttl: $cache_ttl
    );
  }

  public function getGuildTemplate(string $code, ?int $cache_ttl = 600): array
  {
    return $this->api->request(
      method: RequestTypes::GET,
      endpoint: "guilds/templates/{$code}",
      cache_ttl: $cache_ttl
    );
  }

  public function createGuildFromGuildTemplate(string $code, array $params = [], ?int $cache_ttl = null): array
  {
    return $this->api->request(
      method: RequestTypes::POST,
      endpoint: "guilds/templates/{$code}",
      options: [
        'json' => $params
      ],
      cache_ttl: $cache_ttl
    );
  }

  public function getGuildTemplates(string $guild_id, ?int $cache_ttl = 600): array
  {
    return $this->api->request(
      method: RequestTypes::GET,
      endpoint: "guilds/{$guild_id}/templates",
      cache_ttl: $cache_ttl
    );
  }

  public function createGuildTemplate(string $guild_id, array $params = [], ?int $cache_ttl = null): array
  {
    return $this->api->request(
      method: RequestTypes::POST,
      endpoint: "guilds/{$guild_id}/templates",
      options: [
        'json' => $params
      ],
      cache_ttl: $cache_ttl
    );
  }

  public function syncGuildTemplate(string $guild_id, string $code, ?int $cache_ttl = null): array
  {
    return $this->api->request(
      method: RequestTypes::PUT,
      endpoint: "guilds/{$guild_id}/templates/{$code}",
      cache_ttl: $cache_ttl
    );
  }

  public function modifyGuildTemplate(string $guild_id, string $code, array $params = [], ?int $cache_ttl = null): array
  {
    return $this->api->request(
      method: RequestTypes::PATCH,
      endpoint: "guilds/{$guild_id}/templates/{$code}",
      options: [
        'json' => $params
      ],
      cache_ttl: $cache_ttl
    );
  }

  public function deleteGuildTemplate(string $guild_id, string $code, ?int $cache_ttl = null): array
  {
    return $this->api->request(
      method: RequestTypes::DELETE,
      endpoint: "guilds/{$guild_id}/templates/{$code}",
      cache_ttl: $cache_ttl
    );
  }
}

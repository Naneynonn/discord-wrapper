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

  public function modifyChannel(string $channel_id, array $params = [], string $reason = '', ?int $cache_ttl = null): array
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

  public function getChannelMessages(string $channel_id, array $params = [], ?int $cache_ttl = 600): array
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

  public function getChannelMessage(string $channel_id, string $message_id, ?int $cache_ttl = 600): array
  {
    return $this->api->request(
      method: RequestTypes::GET,
      endpoint: "channels/{$channel_id}/messages/{$message_id}",
      cache_ttl: $cache_ttl
    );
  }

  public function createMessage(string $channel_id, array $params = [], string $reason = '', ?int $cache_ttl = null): array
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

  public function crosspostMessage(string $channel_id, string $message_id, array $params = [], ?int $cache_ttl = null): array
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

  public function createReaction(string $channel_id, string $message_id, string $emoji, ?int $cache_ttl = null): array
  {
    return $this->api->request(
      method: RequestTypes::PUT,
      endpoint: "channels/{$channel_id}/messages/{$message_id}/reactions/{$emoji}/@me",
      cache_ttl: $cache_ttl
    );
  }

  public function deleteOwnReaction(string $channel_id, string $message_id, string $emoji, ?int $cache_ttl = null): array
  {
    return $this->api->request(
      method: RequestTypes::DELETE,
      endpoint: "channels/{$channel_id}/messages/{$message_id}/reactions/{$emoji}/@me",
      cache_ttl: $cache_ttl
    );
  }

  public function deleteUserReaction(string $channel_id, string $message_id, string $emoji, string $user_id, ?int $cache_ttl = null): array
  {
    return $this->api->request(
      method: RequestTypes::DELETE,
      endpoint: "channels/{$channel_id}/messages/{$message_id}/reactions/{$emoji}/{$user_id}",
      cache_ttl: $cache_ttl
    );
  }

  public function getReactions(string $channel_id, string $message_id, string $emoji, array $params = [], ?int $cache_ttl = 600): array
  {
    return $this->api->request(
      method: RequestTypes::GET,
      endpoint: "channels/{$channel_id}/messages/{$message_id}/reactions/{$emoji}",
      options: [
        'query' => $params
      ],
      cache_ttl: $cache_ttl
    );
  }

  public function deleteAllReactions(string $channel_id, string $message_id, ?int $cache_ttl = null): array
  {
    return $this->api->request(
      method: RequestTypes::DELETE,
      endpoint: "channels/{$channel_id}/messages/{$message_id}/reactions",
      cache_ttl: $cache_ttl
    );
  }

  public function deleteAllReactionsForEmoji(string $channel_id, string $message_id, string $emoji, ?int $cache_ttl = null): array
  {
    return $this->api->request(
      method: RequestTypes::DELETE,
      endpoint: "channels/{$channel_id}/messages/{$message_id}/reactions/{$emoji}",
      cache_ttl: $cache_ttl
    );
  }

  public function editMessage(string $channel_id, string $message_id, array $params = [], ?int $cache_ttl = null): array
  {
    return $this->api->request(
      method: RequestTypes::PATCH,
      endpoint: "channels/{$channel_id}/messages/{$message_id}",
      options: [
        'json' => $params
      ],
      cache_ttl: $cache_ttl
    );
  }

  public function deleteMessage(string $channel_id, string $message_id, string $reason = '', ?int $cache_ttl = null): array
  {
    return $this->api->request(
      method: RequestTypes::DELETE,
      endpoint: "channels/{$channel_id}/messages/{$message_id}",
      options: [
        'reason' => $reason
      ],
      cache_ttl: $cache_ttl
    );
  }

  public function bulkDeleteMessages(string $channel_id, array $params = [], string $reason = '', ?int $cache_ttl = null): array
  {
    return $this->api->request(
      method: RequestTypes::POST,
      endpoint: "channels/{$channel_id}/messages/bulk-delete",
      options: [
        'json' => $params,
        'reason' => $reason
      ],
      cache_ttl: $cache_ttl
    );
  }

  public function editChannelPermissions(string $channel_id, string $overwrite_id, array $params = [], string $reason = '', ?int $cache_ttl = null): array
  {
    return $this->api->request(
      method: RequestTypes::PUT,
      endpoint: "channels/{$channel_id}/permissions/{$overwrite_id}",
      options: [
        'json' => $params,
        'reason' => $reason
      ],
      cache_ttl: $cache_ttl
    );
  }

  public function getChannelInvites(string $channel_id, array $params = [], string $reason = '', ?int $cache_ttl = 600): array
  {
    return $this->api->request(
      method: RequestTypes::GET,
      endpoint: "channels/{$channel_id}/invites",
      options: [
        'json' => $params,
        'reason' => $reason
      ],
      cache_ttl: $cache_ttl
    );
  }

  public function createChannelInvite(string $channel_id, array $params = [], string $reason = '', ?int $cache_ttl = null): array
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

  public function deleteChannelPermission(string $channel_id, string $overwrite_id, string $reason = '', ?int $cache_ttl = null): array
  {
    return $this->api->request(
      method: RequestTypes::DELETE,
      endpoint: "channels/{$channel_id}/permissions/{$overwrite_id}",
      options: [
        'reason' => $reason
      ],
      cache_ttl: $cache_ttl
    );
  }

  public function followAnnouncementChannel(string $channel_id, array $params = [], ?int $cache_ttl = null): array
  {
    return $this->api->request(
      method: RequestTypes::POST,
      endpoint: "channels/{$channel_id}/followers",
      options: [
        'json' => $params
      ],
      cache_ttl: $cache_ttl
    );
  }

  public function triggerTypingIndicator(string $channel_id, ?int $cache_ttl = null): array
  {
    return $this->api->request(
      method: RequestTypes::POST,
      endpoint: "channels/{$channel_id}/typing",
      cache_ttl: $cache_ttl
    );
  }

  public function getPinnedMessages(string $channel_id, ?int $cache_ttl = 600): array
  {
    return $this->api->request(
      method: RequestTypes::GET,
      endpoint: "channels/{$channel_id}/pins",
      cache_ttl: $cache_ttl
    );
  }

  public function pinMessage(string $channel_id, string $message_id, string $reason = '', ?int $cache_ttl = null): array
  {
    return $this->api->request(
      method: RequestTypes::PUT,
      endpoint: "channels/{$channel_id}/pins/{$message_id}",
      options: [
        'reason' => $reason
      ],
      cache_ttl: $cache_ttl
    );
  }

  public function unpinMessage(string $channel_id, string $message_id, string $reason = '', ?int $cache_ttl = null): array
  {
    return $this->api->request(
      method: RequestTypes::DELETE,
      endpoint: "channels/{$channel_id}/pins/{$message_id}",
      options: [
        'reason' => $reason
      ],
      cache_ttl: $cache_ttl
    );
  }

  public function groupDMAddRecipient(string $channel_id, string $user_id, array $params = [], ?int $cache_ttl = null): array
  {
    return $this->api->request(
      method: RequestTypes::PUT,
      endpoint: "channels/{$channel_id}/recipients/{$user_id}",
      options: [
        'json' => $params
      ],
      cache_ttl: $cache_ttl
    );
  }

  public function groupDMRemoveRecipient(string $channel_id, string $user_id, ?int $cache_ttl = null): array
  {
    return $this->api->request(
      method: RequestTypes::DELETE,
      endpoint: "channels/{$channel_id}/recipients/{$user_id}",
      cache_ttl: $cache_ttl
    );
  }

  public function startThreadFromMessage(string $channel_id, string $message_id, array $params = [], string $reason = '', ?int $cache_ttl = null): array
  {
    return $this->api->request(
      method: RequestTypes::POST,
      endpoint: "channels/{$channel_id}/messages/{$message_id}/threads",
      options: [
        'json' => $params,
        'reason' => $reason
      ],
      cache_ttl: $cache_ttl
    );
  }

  public function startThreadWithoutMessage(string $channel_id, array $params = [], string $reason = '', ?int $cache_ttl = null): array
  {
    return $this->api->request(
      method: RequestTypes::POST,
      endpoint: "channels/{$channel_id}/threads",
      options: [
        'json' => $params,
        'reason' => $reason
      ],
      cache_ttl: $cache_ttl
    );
  }

  public function startThreadInForumOrMediaChannel(string $channel_id, array $params = [], string $reason = '', ?int $cache_ttl = null): array
  {
    return $this->api->request(
      method: RequestTypes::POST,
      endpoint: "channels/{$channel_id}/threads",
      options: [
        'json' => $params,
        'reason' => $reason
      ],
      cache_ttl: $cache_ttl
    );
  }

  public function joinThread(string $channel_id, ?int $cache_ttl = null): array
  {
    return $this->api->request(
      method: RequestTypes::PUT,
      endpoint: "channels/{$channel_id}/thread-members/@me",
      cache_ttl: $cache_ttl
    );
  }

  public function addThreadMember(string $channel_id, string $user_id, ?int $cache_ttl = null): array
  {
    return $this->api->request(
      method: RequestTypes::PUT,
      endpoint: "channels/{$channel_id}/thread-members/{$user_id}",
      cache_ttl: $cache_ttl
    );
  }

  public function leaveThread(string $channel_id, ?int $cache_ttl = null): array
  {
    return $this->api->request(
      method: RequestTypes::DELETE,
      endpoint: "channels/{$channel_id}/thread-members/@me",
      cache_ttl: $cache_ttl
    );
  }

  public function removeThreadMember(string $channel_id, string $user_id, ?int $cache_ttl = null): array
  {
    return $this->api->request(
      method: RequestTypes::DELETE,
      endpoint: "channels/{$channel_id}/thread-members/{$user_id}",
      cache_ttl: $cache_ttl
    );
  }

  public function getThreadMember(string $channel_id, string $user_id, array $params = [], ?int $cache_ttl = 600): array
  {
    return $this->api->request(
      method: RequestTypes::GET,
      endpoint: "channels/{$channel_id}/thread-members/{$user_id}",
      options: [
        'query' => $params
      ],
      cache_ttl: $cache_ttl
    );
  }

  public function listThreadMembers(string $channel_id, array $params = [], ?int $cache_ttl = 600): array
  {
    return $this->api->request(
      method: RequestTypes::GET,
      endpoint: "channels/{$channel_id}/thread-members",
      options: [
        'query' => $params
      ],
      cache_ttl: $cache_ttl
    );
  }

  public function listPublicArchivedThreads(string $channel_id, array $params = [], ?int $cache_ttl = 600): array
  {
    return $this->api->request(
      method: RequestTypes::GET,
      endpoint: "channels/{$channel_id}/threads/archived/public",
      options: [
        'query' => $params
      ],
      cache_ttl: $cache_ttl
    );
  }

  public function listPrivateArchivedThreads(string $channel_id, array $params = [], ?int $cache_ttl = 600): array
  {
    return $this->api->request(
      method: RequestTypes::GET,
      endpoint: "channels/{$channel_id}/threads/archived/private",
      options: [
        'query' => $params
      ],
      cache_ttl: $cache_ttl
    );
  }

  public function listJoinedPrivateArchivedThreads(string $channel_id, array $params = [], ?int $cache_ttl = 600): array
  {
    return $this->api->request(
      method: RequestTypes::GET,
      endpoint: "channels/{$channel_id}/users/@me/threads/archived/private",
      options: [
        'query' => $params
      ],
      cache_ttl: $cache_ttl
    );
  }
}

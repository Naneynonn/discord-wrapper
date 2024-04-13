### Get Channel

#### Properties

| property | type |
|----------|------|
| `channel_id` | `string` |
| `cache_ttl` | `?int` |

#### How to use

```php
$channel = $api->channel->getChannel(channel_id: 'channel_id');
```

### Modify Channel

#### Properties

| property | type |
|----------|------|
| `channel_id` | `string` |
| `params` | `array` |
| `reason` | `string` |
| `cache_ttl` | `?int` |

#### How to use

```php
$channel = $api->channel->modifyChannel(channel_id: 'channel_id', params: [], reason: 'reason');
```

### Delete Channel

#### Properties

| property | type |
|----------|------|
| `channel_id` | `string` |
| `reason` | `string` |
| `cache_ttl` | `?int` |

#### How to use

```php
$channel = $api->channel->deleteChannel(channel_id: 'channel_id', reason: 'reason');
```

### Close Channel

#### Properties

| property | type |
|----------|------|
| `channel_id` | `string` |
| `reason` | `string` |
| `cache_ttl` | `?int` |

#### How to use

```php
$channel = $api->channel->closeChannel(channel_id: 'channel_id', reason: 'reason');
```

### Get Channel Messages

#### Properties

| property | type |
|----------|------|
| `channel_id` | `string` |
| `params` | `array` |
| `cache_ttl` | `?int` |

#### How to use

```php
$channel = $api->channel->getChannelMessages(channel_id: 'channel_id', params: []);
```

### Get Channel Message

#### Properties

| property | type |
|----------|------|
| `channel_id` | `string` |
| `message_id` | `string` |
| `cache_ttl` | `?int` |

#### How to use

```php
$channel = $api->channel->getChannelMessage(channel_id: 'channel_id', message_id: 'message_id');
```

### Create Message

#### Properties

| property | type |
|----------|------|
| `channel_id` | `string` |
| `params` | `array` |
| `reason` | `string` |
| `cache_ttl` | `?int` |

#### How to use

```php
$channel = $api->channel->createMessage(channel_id: 'channel_id', params: [], reason: 'reason');
```

### Crosspost Message

#### Properties

| property | type |
|----------|------|
| `channel_id` | `string` |
| `message_id` | `string` |
| `params` | `array` |
| `cache_ttl` | `?int` |

#### How to use

```php
$channel = $api->channel->crosspostMessage(channel_id: 'channel_id', message_id: 'message_id', params: []);
```

### Create Reaction

#### Properties

| property | type |
|----------|------|
| `channel_id` | `string` |
| `message_id` | `string` |
| `emoji` | `string` |
| `cache_ttl` | `?int` |

#### How to use

```php
$channel = $api->channel->createReaction(channel_id: 'channel_id', message_id: 'message_id', emoji: 'emoji');
```

### Delete Own Reaction

#### Properties

| property | type |
|----------|------|
| `channel_id` | `string` |
| `message_id` | `string` |
| `emoji` | `string` |
| `cache_ttl` | `?int` |

#### How to use

```php
$channel = $api->channel->deleteOwnReaction(channel_id: 'channel_id', message_id: 'message_id', emoji: 'emoji');
```

### Delete User Reaction

#### Properties

| property | type |
|----------|------|
| `channel_id` | `string` |
| `message_id` | `string` |
| `emoji` | `string` |
| `user_id` | `string` |
| `cache_ttl` | `?int` |

#### How to use

```php
$channel = $api->channel->deleteUserReaction(channel_id: 'channel_id', message_id: 'message_id', emoji: 'emoji', user_id: 'user_id');
```

### Get Reactions

#### Properties

| property | type |
|----------|------|
| `channel_id` | `string` |
| `message_id` | `string` |
| `emoji` | `string` |
| `params` | `array` |
| `cache_ttl` | `?int` |

#### How to use

```php
$channel = $api->channel->getReactions(channel_id: 'channel_id', message_id: 'message_id', emoji: 'emoji', params: []);
```

### Delete All Reactions

#### Properties

| property | type |
|----------|------|
| `channel_id` | `string` |
| `message_id` | `string` |
| `cache_ttl` | `?int` |

#### How to use

```php
$channel = $api->channel->deleteAllReactions(channel_id: 'channel_id', message_id: 'message_id');
```

### Delete All Reactions For Emoji

#### Properties

| property | type |
|----------|------|
| `channel_id` | `string` |
| `message_id` | `string` |
| `emoji` | `string` |
| `cache_ttl` | `?int` |

#### How to use

```php
$channel = $api->channel->deleteAllReactionsForEmoji(channel_id: 'channel_id', message_id: 'message_id', emoji: 'emoji');
```

### Edit Message

#### Properties

| property | type |
|----------|------|
| `channel_id` | `string` |
| `message_id` | `string` |
| `params` | `array` |
| `cache_ttl` | `?int` |

#### How to use

```php
$channel = $api->channel->editMessage(channel_id: 'channel_id', message_id: 'message_id', params: []);
```

### Delete Message

#### Properties

| property | type |
|----------|------|
| `channel_id` | `string` |
| `message_id` | `string` |
| `reason` | `string` |
| `cache_ttl` | `?int` |

#### How to use

```php
$channel = $api->channel->deleteMessage(channel_id: 'channel_id', message_id: 'message_id', reason: 'reason');
```

### Bulk Delete Messages

#### Properties

| property | type |
|----------|------|
| `channel_id` | `string` |
| `params` | `array` |
| `reason` | `string` |
| `cache_ttl` | `?int` |

#### How to use

```php
$channel = $api->channel->bulkDeleteMessages(channel_id: 'channel_id', params: [], reason: 'reason');
```

### Edit Channel Permissions

#### Properties

| property | type |
|----------|------|
| `channel_id` | `string` |
| `overwrite_id` | `string` |
| `params` | `array` |
| `reason` | `string` |
| `cache_ttl` | `?int` |

#### How to use

```php
$channel = $api->channel->editChannelPermissions(channel_id: 'channel_id', overwrite_id: 'overwrite_id', params: [], reason: 'reason');
```

### Get Channel Invites

#### Properties

| property | type |
|----------|------|
| `channel_id` | `string` |
| `params` | `array` |
| `reason` | `string` |
| `cache_ttl` | `?int` |

#### How to use

```php
$channel = $api->channel->getChannelInvites(channel_id: 'channel_id', params: [], reason: 'reason');
```

### Create Channel Invite

#### Properties

| property | type |
|----------|------|
| `channel_id` | `string` |
| `params` | `array` |
| `reason` | `string` |
| `cache_ttl` | `?int` |

#### How to use

```php
$channel = $api->channel->createChannelInvite(channel_id: 'channel_id', params: [], reason: 'reason');
```

### Delete Channel Permission

#### Properties

| property | type |
|----------|------|
| `channel_id` | `string` |
| `overwrite_id` | `string` |
| `reason` | `string` |
| `cache_ttl` | `?int` |

#### How to use

```php
$channel = $api->channel->deleteChannelPermission(channel_id: 'channel_id', overwrite_id: 'overwrite_id', reason: 'reason');
```

### Follow Announcement Channel

#### Properties

| property | type |
|----------|------|
| `channel_id` | `string` |
| `params` | `array` |
| `cache_ttl` | `?int` |

#### How to use

```php
$channel = $api->channel->followAnnouncementChannel(channel_id: 'channel_id', params: []);
```

### Trigger Typing Indicator

#### Properties

| property | type |
|----------|------|
| `channel_id` | `string` |
| `cache_ttl` | `?int` |

#### How to use

```php
$channel = $api->channel->triggerTypingIndicator(channel_id: 'channel_id');
```

### Get Pinned Messages

#### Properties

| property | type |
|----------|------|
| `channel_id` | `string` |
| `cache_ttl` | `?int` |

#### How to use

```php
$channel = $api->channel->getPinnedMessages(channel_id: 'channel_id');
```

### Pin Message

#### Properties

| property | type |
|----------|------|
| `channel_id` | `string` |
| `message_id` | `string` |
| `reason` | `string` |
| `cache_ttl` | `?int` |

#### How to use

```php
$channel = $api->channel->pinMessage(channel_id: 'channel_id', message_id: 'message_id', reason: 'reason');
```

### Unpin Message

#### Properties

| property | type |
|----------|------|
| `channel_id` | `string` |
| `message_id` | `string` |
| `reason` | `string` |
| `cache_ttl` | `?int` |

#### How to use

```php
$channel = $api->channel->unpinMessage(channel_id: 'channel_id', message_id: 'message_id', reason: 'reason');
```

### Group D M Add Recipient

#### Properties

| property | type |
|----------|------|
| `channel_id` | `string` |
| `user_id` | `string` |
| `params` | `array` |
| `cache_ttl` | `?int` |

#### How to use

```php
$channel = $api->channel->groupDMAddRecipient(channel_id: 'channel_id', user_id: 'user_id', params: []);
```

### Group D M Remove Recipient

#### Properties

| property | type |
|----------|------|
| `channel_id` | `string` |
| `user_id` | `string` |
| `cache_ttl` | `?int` |

#### How to use

```php
$channel = $api->channel->groupDMRemoveRecipient(channel_id: 'channel_id', user_id: 'user_id');
```

### Start Thread From Message

#### Properties

| property | type |
|----------|------|
| `channel_id` | `string` |
| `message_id` | `string` |
| `params` | `array` |
| `reason` | `string` |
| `cache_ttl` | `?int` |

#### How to use

```php
$channel = $api->channel->startThreadFromMessage(channel_id: 'channel_id', message_id: 'message_id', params: [], reason: 'reason');
```

### Start Thread Without Message

#### Properties

| property | type |
|----------|------|
| `channel_id` | `string` |
| `params` | `array` |
| `reason` | `string` |
| `cache_ttl` | `?int` |

#### How to use

```php
$channel = $api->channel->startThreadWithoutMessage(channel_id: 'channel_id', params: [], reason: 'reason');
```

### Start Thread In Forum Or Media Channel

#### Properties

| property | type |
|----------|------|
| `channel_id` | `string` |
| `params` | `array` |
| `reason` | `string` |
| `cache_ttl` | `?int` |

#### How to use

```php
$channel = $api->channel->startThreadInForumOrMediaChannel(channel_id: 'channel_id', params: [], reason: 'reason');
```

### Join Thread

#### Properties

| property | type |
|----------|------|
| `channel_id` | `string` |
| `cache_ttl` | `?int` |

#### How to use

```php
$channel = $api->channel->joinThread(channel_id: 'channel_id');
```

### Add Thread Member

#### Properties

| property | type |
|----------|------|
| `channel_id` | `string` |
| `user_id` | `string` |
| `cache_ttl` | `?int` |

#### How to use

```php
$channel = $api->channel->addThreadMember(channel_id: 'channel_id', user_id: 'user_id');
```

### Leave Thread

#### Properties

| property | type |
|----------|------|
| `channel_id` | `string` |
| `cache_ttl` | `?int` |

#### How to use

```php
$channel = $api->channel->leaveThread(channel_id: 'channel_id');
```

### Remove Thread Member

#### Properties

| property | type |
|----------|------|
| `channel_id` | `string` |
| `user_id` | `string` |
| `cache_ttl` | `?int` |

#### How to use

```php
$channel = $api->channel->removeThreadMember(channel_id: 'channel_id', user_id: 'user_id');
```

### Get Thread Member

#### Properties

| property | type |
|----------|------|
| `channel_id` | `string` |
| `user_id` | `string` |
| `params` | `array` |
| `cache_ttl` | `?int` |

#### How to use

```php
$channel = $api->channel->getThreadMember(channel_id: 'channel_id', user_id: 'user_id', params: []);
```

### List Thread Members

#### Properties

| property | type |
|----------|------|
| `channel_id` | `string` |
| `params` | `array` |
| `cache_ttl` | `?int` |

#### How to use

```php
$channel = $api->channel->listThreadMembers(channel_id: 'channel_id', params: []);
```

### List Public Archived Threads

#### Properties

| property | type |
|----------|------|
| `channel_id` | `string` |
| `params` | `array` |
| `cache_ttl` | `?int` |

#### How to use

```php
$channel = $api->channel->listPublicArchivedThreads(channel_id: 'channel_id', params: []);
```

### List Private Archived Threads

#### Properties

| property | type |
|----------|------|
| `channel_id` | `string` |
| `params` | `array` |
| `cache_ttl` | `?int` |

#### How to use

```php
$channel = $api->channel->listPrivateArchivedThreads(channel_id: 'channel_id', params: []);
```

### List Joined Private Archived Threads

#### Properties

| property | type |
|----------|------|
| `channel_id` | `string` |
| `params` | `array` |
| `cache_ttl` | `?int` |

#### How to use

```php
$channel = $api->channel->listJoinedPrivateArchivedThreads(channel_id: 'channel_id', params: []);
```


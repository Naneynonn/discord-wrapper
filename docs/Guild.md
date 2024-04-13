### Create Guild

#### Properties

| property | type |
|----------|------|
| `params` | `array` |

#### How to use

```php
$guild = $api->guild->createGuild(params: []);
```

### Get Guild

#### Properties

| property | type |
|----------|------|
| `guild_id` | `string` |
| `params` | `array` |
| `cache_ttl` | `?int` |

#### How to use

```php
$guild = $api->guild->getGuild(guild_id: 'guild_id', params: []);
```

### Get Guild Preview

#### Properties

| property | type |
|----------|------|
| `guild_id` | `string` |
| `cache_ttl` | `?int` |

#### How to use

```php
$guild = $api->guild->getGuildPreview(guild_id: 'guild_id');
```

### Modify Guild

#### Properties

| property | type |
|----------|------|
| `guild_id` | `string` |
| `params` | `array` |
| `reason` | `string` |
| `cache_ttl` | `?int` |

#### How to use

```php
$guild = $api->guild->modifyGuild(guild_id: 'guild_id', params: [], reason: 'reason');
```

### Delete Guild

#### Properties

| property | type |
|----------|------|
| `guild_id` | `string` |

#### How to use

```php
$guild = $api->guild->deleteGuild(guild_id: 'guild_id');
```

### Get Guild Channels

#### Properties

| property | type |
|----------|------|
| `guild_id` | `string` |
| `cache_ttl` | `?int` |

#### How to use

```php
$guild = $api->guild->getGuildChannels(guild_id: 'guild_id');
```

### Create Guild Channel

#### Properties

| property | type |
|----------|------|
| `guild_id` | `string` |
| `params` | `array` |
| `reason` | `string` |
| `cache_ttl` | `?int` |

#### How to use

```php
$guild = $api->guild->createGuildChannel(guild_id: 'guild_id', params: [], reason: 'reason');
```

### Modify Guild Channel Positions

#### Properties

| property | type |
|----------|------|
| `guild_id` | `string` |
| `params` | `array` |
| `cache_ttl` | `?int` |

#### How to use

```php
$guild = $api->guild->modifyGuildChannelPositions(guild_id: 'guild_id', params: []);
```

### List Active Guild Threads

#### Properties

| property | type |
|----------|------|
| `guild_id` | `string` |
| `cache_ttl` | `?int` |

#### How to use

```php
$guild = $api->guild->listActiveGuildThreads(guild_id: 'guild_id');
```

### Get Guild Member

#### Properties

| property | type |
|----------|------|
| `guild_id` | `string` |
| `user_id` | `string` |
| `cache_ttl` | `?int` |

#### How to use

```php
$guild = $api->guild->getGuildMember(guild_id: 'guild_id', user_id: 'user_id');
```

### List Guild Members

#### Properties

| property | type |
|----------|------|
| `guild_id` | `string` |
| `params` | `array` |
| `cache_ttl` | `?int` |

#### How to use

```php
$guild = $api->guild->listGuildMembers(guild_id: 'guild_id', params: []);
```

### Search Guild Members

#### Properties

| property | type |
|----------|------|
| `guild_id` | `string` |
| `params` | `array` |
| `cache_ttl` | `?int` |

#### How to use

```php
$guild = $api->guild->searchGuildMembers(guild_id: 'guild_id', params: []);
```

### Add Guild Member

#### Properties

| property | type |
|----------|------|
| `guild_id` | `string` |
| `user_id` | `string` |
| `params` | `array` |
| `cache_ttl` | `?int` |

#### How to use

```php
$guild = $api->guild->addGuildMember(guild_id: 'guild_id', user_id: 'user_id', params: []);
```

### Modify Guild Member

#### Properties

| property | type |
|----------|------|
| `guild_id` | `string` |
| `user_id` | `string` |
| `params` | `array` |
| `reason` | `string` |
| `cache_ttl` | `?int` |

#### How to use

```php
$guild = $api->guild->modifyGuildMember(guild_id: 'guild_id', user_id: 'user_id', params: [], reason: 'reason');
```

### Modify Current Member

#### Properties

| property | type |
|----------|------|
| `guild_id` | `string` |
| `params` | `array` |
| `reason` | `string` |
| `cache_ttl` | `?int` |

#### How to use

```php
$guild = $api->guild->modifyCurrentMember(guild_id: 'guild_id', params: [], reason: 'reason');
```

### Add Guild Member Role

#### Properties

| property | type |
|----------|------|
| `guild_id` | `string` |
| `user_id` | `string` |
| `role_id` | `string` |
| `reason` | `string` |
| `cache_ttl` | `?int` |

#### How to use

```php
$guild = $api->guild->addGuildMemberRole(guild_id: 'guild_id', user_id: 'user_id', role_id: 'role_id', reason: 'reason');
```

### Remove Guild Member Role

#### Properties

| property | type |
|----------|------|
| `guild_id` | `string` |
| `user_id` | `string` |
| `role_id` | `string` |
| `reason` | `string` |
| `cache_ttl` | `?int` |

#### How to use

```php
$guild = $api->guild->removeGuildMemberRole(guild_id: 'guild_id', user_id: 'user_id', role_id: 'role_id', reason: 'reason');
```

### Remove Guild Member

#### Properties

| property | type |
|----------|------|
| `guild_id` | `string` |
| `user_id` | `string` |
| `reason` | `string` |
| `cache_ttl` | `?int` |

#### How to use

```php
$guild = $api->guild->removeGuildMember(guild_id: 'guild_id', user_id: 'user_id', reason: 'reason');
```

### Get Guild Bans

#### Properties

| property | type |
|----------|------|
| `guild_id` | `string` |
| `params` | `array` |
| `cache_ttl` | `?int` |

#### How to use

```php
$guild = $api->guild->getGuildBans(guild_id: 'guild_id', params: []);
```

### Get Guild Ban

#### Properties

| property | type |
|----------|------|
| `guild_id` | `string` |
| `user_id` | `string` |
| `cache_ttl` | `?int` |

#### How to use

```php
$guild = $api->guild->getGuildBan(guild_id: 'guild_id', user_id: 'user_id');
```

### Create Guild Ban

#### Properties

| property | type |
|----------|------|
| `guild_id` | `string` |
| `user_id` | `string` |
| `params` | `array` |
| `reason` | `string` |
| `cache_ttl` | `?int` |

#### How to use

```php
$guild = $api->guild->createGuildBan(guild_id: 'guild_id', user_id: 'user_id', params: [], reason: 'reason');
```

### Remove Guild Ban

#### Properties

| property | type |
|----------|------|
| `guild_id` | `string` |
| `user_id` | `string` |
| `reason` | `string` |
| `cache_ttl` | `?int` |

#### How to use

```php
$guild = $api->guild->removeGuildBan(guild_id: 'guild_id', user_id: 'user_id', reason: 'reason');
```

### Bulk Guild Ban

#### Properties

| property | type |
|----------|------|
| `guild_id` | `string` |
| `params` | `array` |
| `reason` | `string` |
| `cache_ttl` | `?int` |

#### How to use

```php
$guild = $api->guild->bulkGuildBan(guild_id: 'guild_id', params: [], reason: 'reason');
```

### Get Guild Roles

#### Properties

| property | type |
|----------|------|
| `guild_id` | `string` |
| `cache_ttl` | `?int` |

#### How to use

```php
$guild = $api->guild->getGuildRoles(guild_id: 'guild_id');
```

### Create Guild Role

#### Properties

| property | type |
|----------|------|
| `guild_id` | `string` |
| `params` | `array` |
| `reason` | `string` |
| `cache_ttl` | `?int` |

#### How to use

```php
$guild = $api->guild->createGuildRole(guild_id: 'guild_id', params: [], reason: 'reason');
```

### Modify Guild Role Positions

#### Properties

| property | type |
|----------|------|
| `guild_id` | `string` |
| `params` | `array` |
| `reason` | `string` |
| `cache_ttl` | `?int` |

#### How to use

```php
$guild = $api->guild->modifyGuildRolePositions(guild_id: 'guild_id', params: [], reason: 'reason');
```

### Modify Guild Role

#### Properties

| property | type |
|----------|------|
| `guild_id` | `string` |
| `role_id` | `string` |
| `params` | `array` |
| `reason` | `string` |
| `cache_ttl` | `?int` |

#### How to use

```php
$guild = $api->guild->modifyGuildRole(guild_id: 'guild_id', role_id: 'role_id', params: [], reason: 'reason');
```

### Modify Guild M F A Level

#### Properties

| property | type |
|----------|------|
| `guild_id` | `string` |
| `params` | `array` |
| `reason` | `string` |
| `cache_ttl` | `?int` |

#### How to use

```php
$guild = $api->guild->modifyGuildMFALevel(guild_id: 'guild_id', params: [], reason: 'reason');
```

### Delete Guild Role

#### Properties

| property | type |
|----------|------|
| `guild_id` | `string` |
| `role_id` | `string` |
| `reason` | `string` |
| `cache_ttl` | `?int` |

#### How to use

```php
$guild = $api->guild->deleteGuildRole(guild_id: 'guild_id', role_id: 'role_id', reason: 'reason');
```

### Get Guild Prune Count

#### Properties

| property | type |
|----------|------|
| `guild_id` | `string` |
| `params` | `array` |
| `cache_ttl` | `?int` |

#### How to use

```php
$guild = $api->guild->getGuildPruneCount(guild_id: 'guild_id', params: []);
```

### Begin Guild Prune

#### Properties

| property | type |
|----------|------|
| `guild_id` | `string` |
| `params` | `array` |
| `reason` | `string` |
| `cache_ttl` | `?int` |

#### How to use

```php
$guild = $api->guild->beginGuildPrune(guild_id: 'guild_id', params: [], reason: 'reason');
```

### Get Guild Voice Regions

#### Properties

| property | type |
|----------|------|
| `guild_id` | `string` |
| `cache_ttl` | `?int` |

#### How to use

```php
$guild = $api->guild->getGuildVoiceRegions(guild_id: 'guild_id');
```

### Get Guild Invites

#### Properties

| property | type |
|----------|------|
| `guild_id` | `string` |
| `cache_ttl` | `?int` |

#### How to use

```php
$guild = $api->guild->getGuildInvites(guild_id: 'guild_id');
```

### Get Guild Integrations

#### Properties

| property | type |
|----------|------|
| `guild_id` | `string` |
| `cache_ttl` | `?int` |

#### How to use

```php
$guild = $api->guild->getGuildIntegrations(guild_id: 'guild_id');
```

### Delete Guild Integration

#### Properties

| property | type |
|----------|------|
| `guild_id` | `string` |
| `integration_id` | `string` |
| `reason` | `string` |
| `cache_ttl` | `?int` |

#### How to use

```php
$guild = $api->guild->deleteGuildIntegration(guild_id: 'guild_id', integration_id: 'integration_id', reason: 'reason');
```

### Get Guild Widget Settings

#### Properties

| property | type |
|----------|------|
| `guild_id` | `string` |
| `cache_ttl` | `?int` |

#### How to use

```php
$guild = $api->guild->getGuildWidgetSettings(guild_id: 'guild_id');
```

### Modify Guild Widget

#### Properties

| property | type |
|----------|------|
| `guild_id` | `string` |
| `reason` | `string` |
| `cache_ttl` | `?int` |

#### How to use

```php
$guild = $api->guild->modifyGuildWidget(guild_id: 'guild_id', reason: 'reason');
```

### Get Guild Widget

#### Properties

| property | type |
|----------|------|
| `guild_id` | `string` |
| `cache_ttl` | `?int` |

#### How to use

```php
$guild = $api->guild->getGuildWidget(guild_id: 'guild_id');
```

### Get Guild Vanity U R L

#### Properties

| property | type |
|----------|------|
| `guild_id` | `string` |
| `cache_ttl` | `?int` |

#### How to use

```php
$guild = $api->guild->getGuildVanityURL(guild_id: 'guild_id');
```

### Get Guild Widget Image

#### Properties

| property | type |
|----------|------|
| `guild_id` | `string` |
| `params` | `array` |
| `cache_ttl` | `?int` |

#### How to use

```php
$guild = $api->guild->getGuildWidgetImage(guild_id: 'guild_id', params: []);
```

### Get Guild Welcome Screen

#### Properties

| property | type |
|----------|------|
| `guild_id` | `string` |
| `cache_ttl` | `?int` |

#### How to use

```php
$guild = $api->guild->getGuildWelcomeScreen(guild_id: 'guild_id');
```

### Modify Guild Welcome Screen

#### Properties

| property | type |
|----------|------|
| `guild_id` | `string` |
| `params` | `array` |
| `reason` | `string` |
| `cache_ttl` | `?int` |

#### How to use

```php
$guild = $api->guild->modifyGuildWelcomeScreen(guild_id: 'guild_id', params: [], reason: 'reason');
```

### Get Guild Onboarding

#### Properties

| property | type |
|----------|------|
| `guild_id` | `string` |
| `cache_ttl` | `?int` |

#### How to use

```php
$guild = $api->guild->getGuildOnboarding(guild_id: 'guild_id');
```

### Modify Guild Onboarding

#### Properties

| property | type |
|----------|------|
| `guild_id` | `string` |
| `params` | `array` |
| `reason` | `string` |
| `cache_ttl` | `?int` |

#### How to use

```php
$guild = $api->guild->modifyGuildOnboarding(guild_id: 'guild_id', params: [], reason: 'reason');
```

### Modify Current User Voice State

#### Properties

| property | type |
|----------|------|
| `guild_id` | `string` |
| `params` | `array` |
| `cache_ttl` | `?int` |

#### How to use

```php
$guild = $api->guild->modifyCurrentUserVoiceState(guild_id: 'guild_id', params: []);
```

### Modify User Voice State

#### Properties

| property | type |
|----------|------|
| `guild_id` | `string` |
| `user_id` | `string` |
| `params` | `array` |
| `cache_ttl` | `?int` |

#### How to use

```php
$guild = $api->guild->modifyUserVoiceState(guild_id: 'guild_id', user_id: 'user_id', params: []);
```

### List Scheduled Events For Guild

#### Properties

| property | type |
|----------|------|
| `guild_id` | `string` |
| `params` | `array` |
| `cache_ttl` | `?int` |

#### How to use

```php
$guild = $api->guild->listScheduledEventsForGuild(guild_id: 'guild_id', params: []);
```

### Create Guild Scheduled Event

#### Properties

| property | type |
|----------|------|
| `guild_id` | `string` |
| `params` | `array` |
| `reason` | `string` |
| `cache_ttl` | `?int` |

#### How to use

```php
$guild = $api->guild->createGuildScheduledEvent(guild_id: 'guild_id', params: [], reason: 'reason');
```

### Get Guild Scheduled Event

#### Properties

| property | type |
|----------|------|
| `guild_id` | `string` |
| `event_id` | `string` |
| `params` | `array` |
| `cache_ttl` | `?int` |

#### How to use

```php
$guild = $api->guild->getGuildScheduledEvent(guild_id: 'guild_id', event_id: 'event_id', params: []);
```

### Modify Guild Scheduled Event

#### Properties

| property | type |
|----------|------|
| `guild_id` | `string` |
| `event_id` | `string` |
| `params` | `array` |
| `reason` | `string` |
| `cache_ttl` | `?int` |

#### How to use

```php
$guild = $api->guild->modifyGuildScheduledEvent(guild_id: 'guild_id', event_id: 'event_id', params: [], reason: 'reason');
```

### Delete Guild Scheduled Event

#### Properties

| property | type |
|----------|------|
| `guild_id` | `string` |
| `event_id` | `string` |
| `cache_ttl` | `?int` |

#### How to use

```php
$guild = $api->guild->deleteGuildScheduledEvent(guild_id: 'guild_id', event_id: 'event_id');
```

### Get Guild Scheduled Event Users

#### Properties

| property | type |
|----------|------|
| `guild_id` | `string` |
| `event_id` | `string` |
| `params` | `array` |
| `cache_ttl` | `?int` |

#### How to use

```php
$guild = $api->guild->getGuildScheduledEventUsers(guild_id: 'guild_id', event_id: 'event_id', params: []);
```

### Get Guild Template

#### Properties

| property | type |
|----------|------|
| `code` | `string` |
| `cache_ttl` | `?int` |

#### How to use

```php
$guild = $api->guild->getGuildTemplate(code: 'code');
```

### Create Guild From Guild Template

#### Properties

| property | type |
|----------|------|
| `code` | `string` |
| `params` | `array` |
| `cache_ttl` | `?int` |

#### How to use

```php
$guild = $api->guild->createGuildFromGuildTemplate(code: 'code', params: []);
```

### Get Guild Templates

#### Properties

| property | type |
|----------|------|
| `guild_id` | `string` |
| `cache_ttl` | `?int` |

#### How to use

```php
$guild = $api->guild->getGuildTemplates(guild_id: 'guild_id');
```

### Create Guild Template

#### Properties

| property | type |
|----------|------|
| `guild_id` | `string` |
| `params` | `array` |
| `cache_ttl` | `?int` |

#### How to use

```php
$guild = $api->guild->createGuildTemplate(guild_id: 'guild_id', params: []);
```

### Sync Guild Template

#### Properties

| property | type |
|----------|------|
| `guild_id` | `string` |
| `code` | `string` |
| `cache_ttl` | `?int` |

#### How to use

```php
$guild = $api->guild->syncGuildTemplate(guild_id: 'guild_id', code: 'code');
```

### Modify Guild Template

#### Properties

| property | type |
|----------|------|
| `guild_id` | `string` |
| `code` | `string` |
| `params` | `array` |
| `cache_ttl` | `?int` |

#### How to use

```php
$guild = $api->guild->modifyGuildTemplate(guild_id: 'guild_id', code: 'code', params: []);
```

### Delete Guild Template

#### Properties

| property | type |
|----------|------|
| `guild_id` | `string` |
| `code` | `string` |
| `cache_ttl` | `?int` |

#### How to use

```php
$guild = $api->guild->deleteGuildTemplate(guild_id: 'guild_id', code: 'code');
```


### List Auto Moderation Rules For Guild

#### Properties

| property | type |
|----------|------|
| `guild_id` | `string` |
| `cache_ttl` | `?int` |

#### How to use

```php
$automod = $api->automod->listAutoModerationRulesForGuild(guild_id: 'guild_id');
```

### Get Auto Moderation Rule

#### Properties

| property | type |
|----------|------|
| `guild_id` | `string` |
| `rule_id` | `string` |
| `cache_ttl` | `?int` |

#### How to use

```php
$automod = $api->automod->getAutoModerationRule(guild_id: 'guild_id', rule_id: 'rule_id');
```

### Create Auto Moderation Rule

#### Properties

| property | type |
|----------|------|
| `guild_id` | `string` |
| `params` | `array` |
| `reason` | `string` |
| `cache_ttl` | `?int` |

#### How to use

```php
$automod = $api->automod->createAutoModerationRule(guild_id: 'guild_id', params: [], reason: 'reason');
```

### Modify Auto Moderation Rule

#### Properties

| property | type |
|----------|------|
| `guild_id` | `string` |
| `rule_id` | `string` |
| `params` | `array` |
| `reason` | `string` |
| `cache_ttl` | `?int` |

#### How to use

```php
$automod = $api->automod->modifyAutoModerationRule(guild_id: 'guild_id', rule_id: 'rule_id', params: [], reason: 'reason');
```

### Delete Auto Moderation Rule

#### Properties

| property | type |
|----------|------|
| `guild_id` | `string` |
| `rule_id` | `string` |
| `reason` | `string` |
| `cache_ttl` | `?int` |

#### How to use

```php
$automod = $api->automod->deleteAutoModerationRule(guild_id: 'guild_id', rule_id: 'rule_id', reason: 'reason');
```


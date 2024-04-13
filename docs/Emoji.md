### List Guild Emojis

#### Properties

| property | type |
|----------|------|
| `guild_id` | `string` |
| `cache_ttl` | `?int` |

#### How to use

```php
$emoji = $api->emoji->listGuildEmojis(guild_id: 'guild_id');
```

### List Guild Emoji

#### Properties

| property | type |
|----------|------|
| `guild_id` | `string` |
| `emoji_id` | `string` |
| `cache_ttl` | `?int` |

#### How to use

```php
$emoji = $api->emoji->listGuildEmoji(guild_id: 'guild_id', emoji_id: 'emoji_id');
```

### Create Guild Emoji

#### Properties

| property | type |
|----------|------|
| `guild_id` | `string` |
| `params` | `array` |
| `reason` | `string` |
| `cache_ttl` | `?int` |

#### How to use

```php
$emoji = $api->emoji->createGuildEmoji(guild_id: 'guild_id', params: [], reason: 'reason');
```

### Modify Guild Emoji

#### Properties

| property | type |
|----------|------|
| `guild_id` | `string` |
| `emoji_id` | `string` |
| `params` | `array` |
| `reason` | `string` |
| `cache_ttl` | `?int` |

#### How to use

```php
$emoji = $api->emoji->modifyGuildEmoji(guild_id: 'guild_id', emoji_id: 'emoji_id', params: [], reason: 'reason');
```

### Delete Guild Emoji

#### Properties

| property | type |
|----------|------|
| `guild_id` | `string` |
| `emoji_id` | `string` |
| `reason` | `string` |
| `cache_ttl` | `?int` |

#### How to use

```php
$emoji = $api->emoji->deleteGuildEmoji(guild_id: 'guild_id', emoji_id: 'emoji_id', reason: 'reason');
```


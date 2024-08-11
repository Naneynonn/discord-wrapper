### List Voice Regions

#### Properties

| property | type |
|----------|------|
| `cache_ttl` | `?int` |

#### How to use

```php
$voice = $api->voice->listVoiceRegions();
```

### Get Current User Voice State

#### Properties

| property | type |
|----------|------|
| `guild_id` | `string` |
| `cache_ttl` | `?int` |

#### How to use

```php
$voice = $api->voice->getCurrentUserVoiceState(guild_id: 'guild_id');
```

### Get User Voice State

#### Properties

| property | type |
|----------|------|
| `guild_id` | `string` |
| `user_id` | `string` |
| `cache_ttl` | `?int` |

#### How to use

```php
$voice = $api->voice->getUserVoiceState(guild_id: 'guild_id', user_id: 'user_id');
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
$voice = $api->voice->modifyCurrentUserVoiceState(guild_id: 'guild_id', params: []);
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
$voice = $api->voice->modifyUserVoiceState(guild_id: 'guild_id', user_id: 'user_id', params: []);
```


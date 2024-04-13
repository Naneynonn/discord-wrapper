### Get Sticker

#### Properties

| property | type |
|----------|------|
| `sticker_id` | `string` |
| `cache_ttl` | `?int` |

#### How to use

```php
$sticker = $api->sticker->getSticker(sticker_id: 'sticker_id');
```

### List Sticker Packs

#### Properties

| property | type |
|----------|------|
| `cache_ttl` | `?int` |

#### How to use

```php
$sticker = $api->sticker->listStickerPacks();
```

### List Guild Stickers

#### Properties

| property | type |
|----------|------|
| `guild_id` | `string` |
| `cache_ttl` | `?int` |

#### How to use

```php
$sticker = $api->sticker->listGuildStickers(guild_id: 'guild_id');
```

### Get Guild Sticker

#### Properties

| property | type |
|----------|------|
| `guild_id` | `string` |
| `sticker_id` | `string` |
| `cache_ttl` | `?int` |

#### How to use

```php
$sticker = $api->sticker->getGuildSticker(guild_id: 'guild_id', sticker_id: 'sticker_id');
```

### Create Guild Sticker

#### Properties

| property | type |
|----------|------|
| `guild_id` | `string` |
| `params` | `array` |
| `reason` | `string` |
| `cache_ttl` | `?int` |

#### How to use

```php
$sticker = $api->sticker->createGuildSticker(guild_id: 'guild_id', params: [], reason: 'reason');
```

### Modify Guild Sticker

#### Properties

| property | type |
|----------|------|
| `guild_id` | `string` |
| `sticker_id` | `string` |
| `params` | `array` |
| `reason` | `string` |
| `cache_ttl` | `?int` |

#### How to use

```php
$sticker = $api->sticker->modifyGuildSticker(guild_id: 'guild_id', sticker_id: 'sticker_id', params: [], reason: 'reason');
```

### Delete Guild Sticker

#### Properties

| property | type |
|----------|------|
| `guild_id` | `string` |
| `sticker_id` | `string` |
| `reason` | `string` |
| `cache_ttl` | `?int` |

#### How to use

```php
$sticker = $api->sticker->deleteGuildSticker(guild_id: 'guild_id', sticker_id: 'sticker_id', reason: 'reason');
```


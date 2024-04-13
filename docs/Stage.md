### Create Stage Instance

#### Properties

| property | type |
|----------|------|
| `params` | `array` |
| `reason` | `string` |
| `cache_ttl` | `?int` |

#### How to use

```php
$stage = $api->stage->createStageInstance(params: [], reason: 'reason');
```

### Get Stage Instance

#### Properties

| property | type |
|----------|------|
| `channel_id` | `string` |
| `cache_ttl` | `?int` |

#### How to use

```php
$stage = $api->stage->getStageInstance(channel_id: 'channel_id');
```

### Modify Stage Instance

#### Properties

| property | type |
|----------|------|
| `channel_id` | `string` |
| `params` | `array` |
| `reason` | `string` |
| `cache_ttl` | `?int` |

#### How to use

```php
$stage = $api->stage->modifyStageInstance(channel_id: 'channel_id', params: [], reason: 'reason');
```

### Delete Stage Instance

#### Properties

| property | type |
|----------|------|
| `channel_id` | `string` |
| `reason` | `string` |
| `cache_ttl` | `?int` |

#### How to use

```php
$stage = $api->stage->deleteStageInstance(channel_id: 'channel_id', reason: 'reason');
```


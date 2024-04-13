### Create Webhook

#### Properties

| property | type |
|----------|------|
| `channel_id` | `string` |
| `params` | `array` |
| `reason` | `string` |
| `cache_ttl` | `?int` |

#### How to use

```php
$webhook = $api->webhook->createWebhook(channel_id: 'channel_id', params: [], reason: 'reason');
```

### Get Channel Webhooks

#### Properties

| property | type |
|----------|------|
| `channel_id` | `string` |
| `cache_ttl` | `?int` |

#### How to use

```php
$webhook = $api->webhook->getChannelWebhooks(channel_id: 'channel_id');
```

### Get Guild Webhooks

#### Properties

| property | type |
|----------|------|
| `guild_id` | `string` |
| `cache_ttl` | `?int` |

#### How to use

```php
$webhook = $api->webhook->getGuildWebhooks(guild_id: 'guild_id');
```

### Get Webhook

#### Properties

| property | type |
|----------|------|
| `webhook_id` | `string` |
| `cache_ttl` | `?int` |

#### How to use

```php
$webhook = $api->webhook->getWebhook(webhook_id: 'webhook_id');
```

### Get Webhook With Token

#### Properties

| property | type |
|----------|------|
| `webhook_id` | `string` |
| `webhook_token` | `string` |
| `cache_ttl` | `?int` |

#### How to use

```php
$webhook = $api->webhook->getWebhookWithToken(webhook_id: 'webhook_id', webhook_token: 'webhook_token');
```

### Modify Webhook

#### Properties

| property | type |
|----------|------|
| `webhook_id` | `string` |
| `params` | `array` |
| `reason` | `string` |
| `cache_ttl` | `?int` |

#### How to use

```php
$webhook = $api->webhook->modifyWebhook(webhook_id: 'webhook_id', params: [], reason: 'reason');
```

### Modify Webhook With Token

#### Properties

| property | type |
|----------|------|
| `webhook_id` | `string` |
| `webhook_token` | `string` |
| `params` | `array` |
| `reason` | `string` |
| `cache_ttl` | `?int` |

#### How to use

```php
$webhook = $api->webhook->modifyWebhookWithToken(webhook_id: 'webhook_id', webhook_token: 'webhook_token', params: [], reason: 'reason');
```

### Delete Webhook

#### Properties

| property | type |
|----------|------|
| `webhook_id` | `string` |
| `reason` | `string` |
| `cache_ttl` | `?int` |

#### How to use

```php
$webhook = $api->webhook->deleteWebhook(webhook_id: 'webhook_id', reason: 'reason');
```

### Delete Webhook With Token

#### Properties

| property | type |
|----------|------|
| `webhook_id` | `string` |
| `webhook_token` | `string` |
| `reason` | `string` |
| `cache_ttl` | `?int` |

#### How to use

```php
$webhook = $api->webhook->deleteWebhookWithToken(webhook_id: 'webhook_id', webhook_token: 'webhook_token', reason: 'reason');
```

### Execute Webhook

#### Properties

| property | type |
|----------|------|
| `webhook_id` | `string` |
| `webhook_token` | `string` |
| `params` | `array` |
| `cache_ttl` | `?int` |

#### How to use

```php
$webhook = $api->webhook->executeWebhook(webhook_id: 'webhook_id', webhook_token: 'webhook_token', params: []);
```

### Execute Slack Compatible Webhook

#### Properties

| property | type |
|----------|------|
| `webhook_id` | `string` |
| `webhook_token` | `string` |
| `params` | `array` |
| `cache_ttl` | `?int` |

#### How to use

```php
$webhook = $api->webhook->executeSlackCompatibleWebhook(webhook_id: 'webhook_id', webhook_token: 'webhook_token', params: []);
```

### Execute Git Hub Compatible Webhook

#### Properties

| property | type |
|----------|------|
| `webhook_id` | `string` |
| `webhook_token` | `string` |
| `params` | `array` |
| `cache_ttl` | `?int` |

#### How to use

```php
$webhook = $api->webhook->executeGitHubCompatibleWebhook(webhook_id: 'webhook_id', webhook_token: 'webhook_token', params: []);
```

### Get Webhook Message

#### Properties

| property | type |
|----------|------|
| `webhook_id` | `string` |
| `webhook_token` | `string` |
| `message_id` | `string` |
| `params` | `array` |
| `cache_ttl` | `?int` |

#### How to use

```php
$webhook = $api->webhook->getWebhookMessage(webhook_id: 'webhook_id', webhook_token: 'webhook_token', message_id: 'message_id', params: []);
```

### Edit Webhook Message

#### Properties

| property | type |
|----------|------|
| `webhook_id` | `string` |
| `webhook_token` | `string` |
| `message_id` | `string` |
| `params` | `array` |
| `cache_ttl` | `?int` |

#### How to use

```php
$webhook = $api->webhook->editWebhookMessage(webhook_id: 'webhook_id', webhook_token: 'webhook_token', message_id: 'message_id', params: []);
```


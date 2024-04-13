### Get Guild Audit Log

#### Properties

| property | type |
|----------|------|
| `guild_id` | `string` |
| `params` | `array` |
| `cache_ttl` | `?int` |

#### How to use

```php
$audit = $api->audit->getGuildAuditLog(guild_id: 'guild_id', params: []);
```


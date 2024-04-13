### Get Invite

#### Properties

| property | type |
|----------|------|
| `code` | `string` |
| `params` | `array` |
| `cache_ttl` | `?int` |

#### How to use

```php
$invite = $api->invite->getInvite(code: 'code', params: []);
```

### Delete Invite

#### Properties

| property | type |
|----------|------|
| `code` | `string` |
| `reason` | `string` |
| `cache_ttl` | `?int` |

#### How to use

```php
$invite = $api->invite->deleteInvite(code: 'code', reason: 'reason');
```


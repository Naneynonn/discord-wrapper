### Get Current Application

#### Properties

| property | type |
|----------|------|
| `cache_ttl` | `?int` |

#### How to use

```php
$apps = $api->apps->getCurrentApplication();
```

### Edit Current Application

#### Properties

| property | type |
|----------|------|
| `params` | `array` |
| `cache_ttl` | `?int` |

#### How to use

```php
$apps = $api->apps->editCurrentApplication(params: []);
```

### Get Application Role Connection Metadata Records

#### Properties

| property | type |
|----------|------|
| `application_id` | `string` |
| `cache_ttl` | `?int` |

#### How to use

```php
$apps = $api->apps->getApplicationRoleConnectionMetadataRecords(application_id: 'application_id');
```

### Update Application Role Connection Metadata Records

#### Properties

| property | type |
|----------|------|
| `application_id` | `string` |
| `cache_ttl` | `?int` |

#### How to use

```php
$apps = $api->apps->updateApplicationRoleConnectionMetadataRecords(application_id: 'application_id');
```


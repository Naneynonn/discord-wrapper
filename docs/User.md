### Get Current User

#### Properties

| property | type |
|----------|------|
| `cache_ttl` | `?int` |

#### How to use

```php
$user = $api->user->getCurrentUser();
```

### Get User

#### Properties

| property | type |
|----------|------|
| `user_id` | `string` |
| `cache_ttl` | `?int` |

#### How to use

```php
$user = $api->user->getUser(user_id: 'user_id');
```

### Modify Current User

#### Properties

| property | type |
|----------|------|
| `params` | `array` |
| `cache_ttl` | `?int` |

#### How to use

```php
$user = $api->user->modifyCurrentUser(params: []);
```

### Get Current User Guilds

#### Properties

| property | type |
|----------|------|
| `params` | `array` |
| `cache_ttl` | `?int` |

#### How to use

```php
$user = $api->user->getCurrentUserGuilds(params: []);
```

### Get Current User Guild Member

#### Properties

| property | type |
|----------|------|
| `guild_id` | `string` |
| `cache_ttl` | `?int` |

#### How to use

```php
$user = $api->user->getCurrentUserGuildMember(guild_id: 'guild_id');
```

### Leave Guild

#### Properties

| property | type |
|----------|------|
| `guild_id` | `string` |
| `cache_ttl` | `?int` |

#### How to use

```php
$user = $api->user->leaveGuild(guild_id: 'guild_id');
```

### Create D M

#### Properties

| property | type |
|----------|------|
| `params` | `array` |
| `cache_ttl` | `?int` |

#### How to use

```php
$user = $api->user->createDM(params: []);
```

### Create Group D M

#### Properties

| property | type |
|----------|------|
| `params` | `array` |
| `cache_ttl` | `?int` |

#### How to use

```php
$user = $api->user->createGroupDM(params: []);
```

### Get Current User Connections

#### Properties

| property | type |
|----------|------|
| `cache_ttl` | `?int` |

#### How to use

```php
$user = $api->user->getCurrentUserConnections();
```

### Get Current User Application Role Connection

#### Properties

| property | type |
|----------|------|
| `application_id` | `string` |
| `cache_ttl` | `?int` |

#### How to use

```php
$user = $api->user->getCurrentUserApplicationRoleConnection(application_id: 'application_id');
```

### Update Current User Application Role Connection

#### Properties

| property | type |
|----------|------|
| `application_id` | `string` |
| `params` | `array` |
| `cache_ttl` | `?int` |

#### How to use

```php
$user = $api->user->updateCurrentUserApplicationRoleConnection(application_id: 'application_id', params: []);
```


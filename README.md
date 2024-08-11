# discord-wrapper

## Example

```php
require 'vendor/autoload.php';

use Naneynonn\Api\Client as DiscordApiClient;
use Naneynonn\Enums\RequestTypes;

$config = [
  'bot' => [
    'token' => '',
  ]
];

$api = new DiscordApiClient($config);

$guild = $api->guild->getGuild(guild_id: '');
// or
$guild = $api->request(method: RequestTypes::GET, endpoint: '/guilds/{guild.id}', options: ['params' => ['guild.id' => '']], cache_ttl: 600);
```

## All Resources (Wiki)

- [Application](https://github.com/Naneynonn/discord-wrapper/wiki/Application)
- [Audit Log](https://github.com/Naneynonn/discord-wrapper/wiki/Audit-Log)
- [Auto Moderation](https://github.com/Naneynonn/discord-wrapper/wiki/Auto-Moderation)
- [Channel](https://github.com/Naneynonn/discord-wrapper/wiki/Channel)
- [Emoji](https://github.com/Naneynonn/discord-wrapper/wiki/Emoji)
- [Guild](https://github.com/Naneynonn/discord-wrapper/wiki/Guild)
- [Invite](https://github.com/Naneynonn/discord-wrapper/wiki/Invite)
- [Poll](https://github.com/Naneynonn/discord-wrapper/wiki/Poll)
- [Stage Instance](https://github.com/Naneynonn/discord-wrapper/wiki/Stage-Instance)
- [Sticker](https://github.com/Naneynonn/discord-wrapper/wiki/Sticker)
- [User](https://github.com/Naneynonn/discord-wrapper/wiki/User)
- [Voice](https://github.com/Naneynonn/discord-wrapper/wiki/Voice)
- [Webhook](https://github.com/Naneynonn/discord-wrapper/wiki/Webhook)

## Cache and others

- [Wiki](https://github.com/Naneynonn/discord-wrapper/wiki)

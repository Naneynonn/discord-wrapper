# discord-wrapper

Example:

```
require 'vendor/autoload.php';

use Naneynonn\Api\Client as DiscordApiClient;

$config = [
  'bot' => [
    'token' => '',
  ]
];

$api = new DiscordApiClient($config);

$guild = $api->guild->getGuild(guild_id: '');
// or
$guild = $api->request(method: 'GET', endpoint: '/guilds/{guild.id}', options: ['params' => ['guild.id' => '']], cache_ttl: $cache_ttl);
```

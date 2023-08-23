# discord-wrapper

Example:
```
require 'vendor/autoload.php';

use Naneynonn\DiscordApiClient;

$config = [
  'bot' => [
    'token' => '',
  ]
];

$options = [CURLOPT_FORBID_REUSE => false];
$cache_ttl = 300;

$api = new DiscordApiClient($config);
$guild = $api->guild->getGuild(server_id: '');
// or
$guild = $api->request(method: 'GET', endpoint: '/guilds/{guild.id}', params: ['guild.id' => ''], options: $options, cache_ttl: $cache_ttl);
```

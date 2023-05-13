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

$api = new DiscordApiClient($config);
$guild = $api->guild->getGuild(server_id: '');
```

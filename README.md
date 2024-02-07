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
$guild = $api->request(method: 'GET', endpoint: '/guilds/{guild.id}', options: ['params' => ['guild.id' => '']], cache_ttl: 600);
```

Config:

```
$config = [
  // Default conf
  'bot' => [
    'token' => '',
  ],

  // If true, it will wait for the right limit to be exited and the code will be executed again
  'retry' => true

  // If you need proxies
  'proxy' => [
    'http'  => 'http://localhost:8125', // Use this proxy with "http"
    'https' => 'http://localhost:9124', // Use this proxy with "https",
    'no' => ['.mit.edu', 'foo.com']    // Don't use a proxy with these
    ]
];
```

Custom api request:
`Just plug in the data from the API: https://discord.com/developers/docs/intro`

```
$api = new DiscordApiClient($config);
$api->request(
  method: 'GET',
  endpoint: '/guilds/{guild.id}',
  options: [
    // API parameters
    'params' => [
      'guild.id' => ''
    ],

    // For GET requests with additional parameters
    'query' => [
      'foo' => 'bar'
    ],

    // For POST requests with parameters
    'json' => [
      'foo' => 'bar'
    ],

    // Reason field
    'reason' => ''
  ]

  // If you don't want to use the cache, set it to Null
  cache_ttl: 600);
```

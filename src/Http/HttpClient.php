<?php

declare(strict_types=1);

namespace Naneynonn\Http;

use Naneynonn\Const\Config;
use Naneynonn\Enums\RequestTypes;
use Naneynonn\Util\RateLimit;

use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Exception\GuzzleException;

use RuntimeException;

class HttpClient
{
  use Config;

  private GuzzleClient $guzzle;
  private bool $retry;

  public function __construct(?array $proxy = null, bool $retry = true, ?string $baseUri = null)
  {
    $this->retry = $retry;

    $this->guzzle = new GuzzleClient([
      'base_uri' => $baseUri ?? self::BASE_URI,
      'headers'  => [
        'User-Agent'      => self::HEADERS['User-Agent'],
        'Accept-Encoding' => self::HEADERS['Accept-Encoding'],
        'version'         => self::HEADERS['version'],
      ],
      'proxy'       => $proxy,
      'http_errors' => false,
    ]);
  }

  public function send(RequestTypes $method, string $url, array $options = []): string
  {
    try {
      $request = fn() => $this->guzzle->request(method: $method->value, uri: $url, options: $options);

      $response = $request();
      $response = RateLimit::handle(response: $response, request: $request, retry: $this->retry);

      // $status = $response->getStatusCode();
      // if ($status >= 400) {
      //   $body = $response->getBody()->getContents();
      //   throw new RuntimeException("Discord API error ({$status}): {$body}");
      // }

      return $response->getBody()->getContents();
    } catch (GuzzleException $e) {
      throw new RuntimeException("HTTP request failed: " . $e->getMessage());
    }
  }
}

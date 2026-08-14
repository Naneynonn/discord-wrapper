<?php

declare(strict_types=1);

namespace Naneynonn\Http;

use Naneynonn\Const\Config;
use Naneynonn\Enums\RequestTypes;
use Naneynonn\Util\RateLimit;

use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Exception\GuzzleException;
use Psr\Http\Message\ResponseInterface;

use RuntimeException;

class HttpClient
{
  use Config;

  private GuzzleClient $guzzle;
  private bool $retry;

  public function __construct(?array $proxy = null, bool $retry = true, ?string $baseUri = null, float $timeout = 10.0, float $connectTimeout = 3.0)
  {
    $this->retry = $retry;

    $this->guzzle = new GuzzleClient([
      'base_uri' => $baseUri ?? self::BASE_URI,
      'headers'  => [
        'User-Agent'      => self::HEADERS['User-Agent'],
        'Accept-Encoding' => self::HEADERS['Accept-Encoding'],
        'version'         => self::HEADERS['version'],
      ],
      'proxy'           => $proxy,
      'http_errors'     => false,
      'timeout'         => $timeout,
      'connect_timeout' => $connectTimeout,
    ]);
  }

  public function send(RequestTypes $method, string $url, array $options = []): string
  {
    return $this->sendResponse(method: $method, url: $url, options: $options)->getBody()->getContents();
  }

  public function sendResponse(RequestTypes $method, string $url, array $options = []): ResponseInterface
  {
    try {
      $request = fn() => $this->guzzle->request(method: $method->value, uri: $url, options: $options);

      $response = $request();

      return RateLimit::handle(response: $response, request: $request, retry: $this->retry);
    } catch (GuzzleException $e) {
      throw new RuntimeException('HTTP request failed: ' . $e->getMessage(), previous: $e);
    }
  }
}

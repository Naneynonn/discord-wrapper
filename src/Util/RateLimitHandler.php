<?php

declare(strict_types=1);

namespace Naneynonn\Util;

use Psr\Http\Message\ResponseInterface;
use RuntimeException;

class RateLimitHandler
{
  public static function handle(ResponseInterface $response, callable $retryRequest, bool $retry): ResponseInterface
  {
    if ($response->getStatusCode() !== 429) {
      return $response;
    }

    if (!$retry) {
      throw new RuntimeException("Rate limit exceeded, retry not allowed.");
    }

    $retryAfter = $response->hasHeader('Retry-After') ? (int) $response->getHeaderLine('Retry-After') : 0;
    usleep($retryAfter * 1000000);

    return $retryRequest();
  }
}

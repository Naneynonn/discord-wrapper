<?php

declare(strict_types=1);

namespace Naneynonn\Util;

use Psr\Http\Message\ResponseInterface;
use RuntimeException;

final class RateLimit
{
  public static function handle(ResponseInterface $response, callable $request, bool $retry): ResponseInterface
  {
    if ($response->getStatusCode() !== 429) {
      return $response;
    }

    if (!$retry) {
      throw new RuntimeException('Rate limit exceeded, retry not allowed.');
    }

    self::forceCloseSession();

    $retryAfter = max(0, (int) $response->getHeaderLine('Retry-After'));
    usleep($retryAfter * 1000000);

    return $request();
  }

  private static function forceCloseSession(): void
  {
    if (session_status() === PHP_SESSION_ACTIVE) {
      session_write_close();
    }
  }
}

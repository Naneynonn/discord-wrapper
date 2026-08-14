<?php

declare(strict_types=1);

namespace Naneynonn\Util;

use Psr\Http\Message\ResponseInterface;

final class RateLimit
{
  public static function handle(ResponseInterface $response, callable $request, bool $retry): ResponseInterface
  {
    if ($response->getStatusCode() !== 429 || !$retry) {
      return $response;
    }

    self::forceCloseSession();

    $retryAfter = self::getRetryAfter($response);

    if ($retryAfter > 0) {
      usleep((int) ceil($retryAfter * 1_000_000));
    }

    return $request();
  }

  private static function getRetryAfter(ResponseInterface $response): float
  {
    $header = $response->getHeaderLine('Retry-After');

    if (is_numeric($header)) {
      return max(0.0, (float) $header);
    }

    $data = json_decode((string) $response->getBody(), true);

    return isset($data['retry_after']) && is_numeric($data['retry_after'])
      ? max(0.0, (float) $data['retry_after'])
      : 0.0;
  }

  private static function forceCloseSession(): void
  {
    if (session_status() === PHP_SESSION_ACTIVE) {
      session_write_close();
    }
  }
}

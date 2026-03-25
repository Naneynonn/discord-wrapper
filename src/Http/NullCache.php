<?php

declare(strict_types=1);

namespace Naneynonn\Http;

final class NullCache
{
  public function get(string $key): ?string
  {
    return null;
  }
  public function set(string $key, string $value, int $ttl): void {}
  public function del(string $key): void {}
}

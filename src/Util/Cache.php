<?php

declare(strict_types=1);

namespace Naneynonn\Util;

use Predis\Client as RedisClient;

final class Cache
{
  private const int TTL = 3600;

  public static function get(RedisClient $redis, string $key): ?string
  {
    return $redis->get($key);
  }

  public static function set(RedisClient $redis, string $key, string $value, int $ttl): void
  {
    $redis->set($key, $value, 'EX', $ttl);
  }

  public static function del(RedisClient $redis, string $key): void
  {
    $redis->del($key);
  }

  private static function generateKey(array $data): string
  {
    ksort($data);
    return hash('sha256', json_encode($data, JSON_THROW_ON_ERROR));
  }

  private static function unpack(?string $data): ?array
  {
    if (is_null($data) || $data == '') {
      return null;
    }

    return json_decode($data, true, 512, JSON_THROW_ON_ERROR);
  }

  public static function request(RedisClient $redis, callable $fn, array $params, int $ttl = self::TTL): ?array
  {
    $key = self::generateKey(data: $params);
    $get = $redis->get($key);

    if (!is_null($get)) {
      return self::unpack($get);
    }

    $result = $fn();

    if (!is_null($result) && $ttl > 0) {
      self::set(redis: $redis, key: $key, value: $result, ttl: $ttl);
    }

    return self::unpack($result);
  }
}

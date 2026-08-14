<?php

declare(strict_types=1);

namespace Naneynonn\Util;

use Predis\Client as RedisClient;

use JsonException;

final class Cache
{
  private const int TTL = 3600;

  public static function get(RedisClient $redis, string $key): ?string
  {
    return $redis->get($key);
  }

  public static function set(RedisClient $redis, string $key, string $value, int $ttl): void
  {
    if ($ttl <= 0) {
      return;
    }

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
    if (empty($data)) {
      return null;
    }

    return json_decode($data, true, 512, JSON_THROW_ON_ERROR);
  }

  public static function request(RedisClient $redis, callable $fn, array $params, int $ttl = self::TTL, ?callable $shouldCache = null): ?array
  {
    if ($ttl <= 0) {
      return self::unpack($fn());
    }

    try {
      $key = self::generateKey(data: $params);
    } catch (JsonException) {
      return self::unpack($fn());
    }

    $get = self::get(redis: $redis, key: $key);

    if ($get !== null) {
      try {
        return self::unpack($get);
      } catch (JsonException) {
        self::del(redis: $redis, key: $key);
      }
    }

    $result = $fn();
    $unpacked = self::unpack($result);

    if ($result !== null && ($shouldCache === null || $shouldCache())) {
      self::set(redis: $redis, key: $key, value: $result, ttl: $ttl);
    }

    return $unpacked;
  }
}

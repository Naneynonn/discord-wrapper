<?php

namespace Naneynonn;

use Predis\Client as PredisClient;

class CacheManager
{
  private PredisClient $predisClient;
  private const NAME = 'wrapper';

  public function __construct()
  {
    $this->predisClient = new PredisClient();
  }

  public function get(string $key): ?string
  {
    return $this->predisClient->get($key);
  }

  public function set(string $key, string $value, int $ttl): void
  {
    $this->predisClient->set($key, $value, 'EX', $ttl);
  }

  public function clear(string $key): void
  {
    $this->predisClient->del($key);
  }

  public function generateKey(string $url, ?array $data, ?string $customKey = null): string
  {
    if ($customKey) {
      return self::NAME . ':' . md5($customKey);
    }
    return self::NAME . ':' . md5($url . serialize($data));
  }
}

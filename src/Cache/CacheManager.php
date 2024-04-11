<?php

declare(strict_types=1);

namespace Naneynonn\Cache;

use Predis\Client as PredisClient;

final class CacheManager
{
  private PredisClient $predisClient;
  private const NAME = 'wrapper';

  public function __construct()
  {
    $this->predisClient = new PredisClient(options: ['prefix' => self::NAME . ':']);
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
      return md5($customKey);
    }
    return md5($url . serialize($data));
  }

  public function requestWithCache(string $key, callable $requestFunction, ?int $ttl = null): array
  {
    if (is_null($ttl)) {
      $responseBody = $requestFunction();

      if (!empty($responseBody)) {
        return json_decode($responseBody, true, 512, JSON_THROW_ON_ERROR);
      }

      return [];
    }

    $cachedResponse = $this->get($key);
    if (!is_null($cachedResponse)) {
      return json_decode($cachedResponse, true);
    }

    $responseBody = $requestFunction();

    if (!empty($responseBody)) {
      $decodedBody = json_decode($responseBody, true, 512, JSON_THROW_ON_ERROR);

      // Проверяем, не содержит ли ответ информацию о превышении лимита запросов
      if (empty($decodedBody['retry_after'])) {
        $this->set($key, $responseBody, $ttl);
      }

      return $decodedBody;
    }

    return [];
  }
}

<?php

declare(strict_types=1);

namespace Naneynonn\Util;

use InvalidArgumentException;

class ConfigValidator
{
  public static function validate(array $config): void
  {
    self::validateToken($config['bot']['token'] ?? '');
    self::validateProxyConfig($config['proxy'] ?? []);
    self::validateRetry($config['retry'] ?? true);
  }

  private static function validateToken(string $token): void
  {
    if (empty($token)) {
      throw new InvalidArgumentException('Token must be a non-empty string');
    }
  }

  private static function validateProxyConfig(array $proxyConfig): void
  {
    if (empty($proxyConfig)) {
      return;
    }

    // Проверяем, что для http и https указаны корректные URL
    if (isset($proxyConfig['http']) && !filter_var($proxyConfig['http'], FILTER_VALIDATE_URL)) {
      throw new InvalidArgumentException("Proxy http must be a valid URL");
    }

    if (isset($proxyConfig['https']) && !filter_var($proxyConfig['https'], FILTER_VALIDATE_URL)) {
      throw new InvalidArgumentException("Proxy https must be a valid URL");
    }

    // Проверяем, что массив 'no' содержит только строки
    if (isset($proxyConfig['no']) && is_array($proxyConfig['no'])) {
      foreach ($proxyConfig['no'] as $noProxy) {
        if (!is_string($noProxy)) {
          throw new InvalidArgumentException("Each 'no' proxy configuration must be a string");
        }
      }
    } else if (isset($proxyConfig['no'])) {
      throw new InvalidArgumentException("'no' proxy configuration must be an array");
    }
  }

  private static function validateRetry($check): void
  {
    if (isset($check) && !is_bool($check)) {
      throw new InvalidArgumentException('Retry must be a boolean value');
    }
  }
}

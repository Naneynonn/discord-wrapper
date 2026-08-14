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
    self::validateTimeout($config['timeout'] ?? 10.0, 'timeout');
    self::validateTimeout($config['connect_timeout'] ?? 3.0, 'connect_timeout');
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

    if (isset($proxyConfig['http']) && !filter_var($proxyConfig['http'], FILTER_VALIDATE_URL)) {
      throw new InvalidArgumentException('Proxy http must be a valid URL');
    }

    if (isset($proxyConfig['https']) && !filter_var($proxyConfig['https'], FILTER_VALIDATE_URL)) {
      throw new InvalidArgumentException('Proxy https must be a valid URL');
    }

    if (isset($proxyConfig['no']) && is_array($proxyConfig['no'])) {
      foreach ($proxyConfig['no'] as $noProxy) {
        if (!is_string($noProxy)) {
          throw new InvalidArgumentException("Each 'no' proxy configuration must be a string");
        }
      }
    } elseif (isset($proxyConfig['no'])) {
      throw new InvalidArgumentException("'no' proxy configuration must be an array");
    }
  }

  private static function validateRetry(mixed $check): void
  {
    if (!is_bool($check)) {
      throw new InvalidArgumentException('Retry must be a boolean value');
    }
  }

  private static function validateTimeout(mixed $value, string $name): void
  {
    if (!is_numeric($value)) {
      throw new InvalidArgumentException("{$name} must be numeric");
    }

    if ((float) $value < 0) {
      throw new InvalidArgumentException("{$name} must be greater than or equal to 0");
    }
  }
}

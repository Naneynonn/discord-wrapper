<?php

declare(strict_types=1);

namespace Naneynonn\Const;

trait Config
{
  private const DISCORD = 'https://discord.com';
  private const VERSION = 'v10';

  private const BASE_URI = self::DISCORD . '/api/' . self::VERSION . '/';
  private const HEADERS = [
    'Content-Type' => 'application/json',
    'version' => 2.0,
    'User-Agent' => 'Discord-Wrapper/2.0',
    'Accept-Encoding' => 'gzip, deflate',
  ];
}

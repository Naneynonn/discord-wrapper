<?php

declare(strict_types=1);

namespace Naneynonn\Enums;

enum RequestTypes: string
{
  case GET = 'GET';
  case POST = 'POST';
  case PUT = 'PUT';
  case PATCH = 'PATCH';
  case DELETE = 'DELETE';
}

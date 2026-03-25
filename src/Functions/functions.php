<?php

declare(strict_types=1);

namespace Naneynonn\Functions;

function isUnauthorized(?array $response, string $back_url): void
{
  if (is_null($response)) {
    header("Location: {$back_url}");
    die();
  }

  if (isset($response['code']) && $response['code'] === 0) {
    header("Location: {$back_url}");
    die();
  }
}

function getDecodeImage(string $url): string
{
  $path = $url;
  $type = pathinfo($path, PATHINFO_EXTENSION);
  $data = file_get_contents($path);
  return 'data:image/' . $type . ';base64,' . base64_encode($data);
}

function saveUserToSession(array $response): void
{
  $_SESSION['user'] = $response;
  $_SESSION['username'] = $response['username'] ?? 'Unknown';
  $_SESSION['discrim'] = $response['discriminator'] ?? '0000';
  $_SESSION['user_id'] = $response['id'] ?? null;
  $_SESSION['user_avatar'] = $response['avatar'] ?? null;
}

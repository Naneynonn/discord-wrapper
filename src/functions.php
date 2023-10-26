<?php

namespace Naneynonn;

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

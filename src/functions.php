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

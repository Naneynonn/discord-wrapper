<?php

declare(strict_types=1);

namespace Naneynonn\Util;

class HttpUtils
{
  public static function withAuditLogReason(?string $reason): array
  {
    return is_null($reason) ? [] : ['X-Audit-Log-Reason' => rawurlencode($reason)];
  }
}

<?php

declare(strict_types=1);

namespace Naneynonn\Enums;

enum MfaLevel: int
{
    case NONE = 0;
    case ELEVATED = 1;
}

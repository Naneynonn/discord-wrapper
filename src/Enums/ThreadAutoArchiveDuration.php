<?php

declare(strict_types=1);

namespace Naneynonn\Enums;

enum ThreadAutoArchiveDuration: int
{
    case MINUTES_60 = 60;
    case MINUTES_1440 = 1440;
    case MINUTES_4320 = 4320;
    case MINUTES_10080 = 10080;
}

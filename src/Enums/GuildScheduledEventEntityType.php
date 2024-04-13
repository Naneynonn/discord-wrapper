<?php

declare(strict_types=1);

namespace Naneynonn\Enums;

enum GuildScheduledEventEntityType: int
{
    case STAGE_INSTANCE = 1;
    case VOICE = 2;
    case EXTERNAL = 3;
}

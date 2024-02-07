<?php

declare(strict_types=1);

namespace Naneynonn\Enums;

enum PrivacyLevel: int
{
    case PUBLIC = 1;
    case GUILD_ONLY = 2;
}

<?php

declare(strict_types=1);

namespace Naneynonn\Enums;

enum ExplicitContentFilterLevel: int
{
    case DISABLED = 0;
    case MEMBERS_WITHOUT_ROLES = 1;
    case ALL_MEMBERS = 2;
}

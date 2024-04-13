<?php

declare(strict_types=1);

namespace Naneynonn\Enums;

enum ApplicationCommandPermissionType: int
{
    case ROLE = 1;
    case USER = 2;
    case CHANNEL = 3;
}

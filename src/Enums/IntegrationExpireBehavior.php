<?php

declare(strict_types=1);

namespace Naneynonn\Enums;

enum IntegrationExpireBehavior: int
{
    case REMOVE_ROLE = 0;
    case KICK = 1;
}

<?php

declare(strict_types=1);

namespace Naneynonn\Enums;

enum MessageActivityType: int
{
    case JOIN  = 1;
    case SPECTATE  = 2;
    case LISTEN  = 3;
    case JOIN_REQUEST  = 5;
}

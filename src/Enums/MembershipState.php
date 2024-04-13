<?php

declare(strict_types=1);

namespace Naneynonn\Enums;

enum MembershipState: int
{
    case INVITED = 1;
    case ACCEPTED = 2;
}

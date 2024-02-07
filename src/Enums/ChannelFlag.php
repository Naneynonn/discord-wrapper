<?php

declare(strict_types=1);

namespace Naneynonn\Enums;

enum ChannelFlag: int
{
    case PINNED = 1 << 1;
    case REQUIRE_TAG = 1 << 4;
}

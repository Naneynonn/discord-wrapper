<?php

declare(strict_types=1);

namespace Naneynonn\Enums;

enum AutoModerationKeywordPresetType: int
{
    case PROFANITY = 1;
    case SEXUAL_CONTENT = 2;
    case SLURS = 3;
}

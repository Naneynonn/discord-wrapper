<?php

declare(strict_types=1);

namespace Naneynonn\Enums;

enum StickerFormatType: int
{
    case PNG = 1;
    case APNG = 2;
    case LOTTIE = 3;
    case GIF = 4;
}

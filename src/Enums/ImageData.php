<?php

declare(strict_types=1);

namespace Naneynonn\Enums;

enum ImageData: string
{
    case JPG = 'image/jpeg';
    case PNG = 'image/png';
    case GIF = 'image/gif';
}

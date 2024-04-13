<?php

declare(strict_types=1);

namespace Naneynonn\Enums;

enum EmbedType: string
{
    case RICH = 'rich';
    case IMAGE = 'image';
    case VIDEO = 'video';
    case GIFV = 'gifv';
    case ARTICLE = 'article';
    case LINK = 'link';
}

<?php

declare(strict_types=1);

namespace Naneynonn\Enums;

enum StatusType: string
{
    case ONLINE = 'online';
    case DO_NOT_DISTURB = 'dnd';
    case AFK = 'idle';
    case INVISIBLE = 'invisible';
    case OFFLINE = 'offline';
}

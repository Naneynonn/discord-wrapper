<?php

declare(strict_types=1);

namespace Naneynonn\Enums;

enum ComponentType: int
{
  // Layout
  case ACTION_ROW         = 1;

    // Interactive (V1)
  case BUTTON             = 2;
  case STRING_SELECT      = 3;
  case TEXT_INPUT         = 4;
  case USER_SELECT        = 5;
  case ROLE_SELECT        = 6;
  case MENTIONABLE_SELECT = 7;
  case CHANNEL_SELECT     = 8;

    // V2 — Layout
  case SECTION            = 9;
  case SEPARATOR          = 14;
  case CONTAINER          = 17;
  case LABEL              = 18;  // Modal only

    // V2 — Content
  case TEXT_DISPLAY       = 10;
  case THUMBNAIL          = 11;
  case MEDIA_GALLERY      = 12;
  case FILE               = 13;

    // V2 — Interactive (Modal)
  case FILE_UPLOAD        = 19;  // Modal only
  case RADIO_GROUP        = 21;  // Modal only
  case CHECKBOX_GROUP     = 22;  // Modal only
  case CHECKBOX           = 23;  // Modal only
}

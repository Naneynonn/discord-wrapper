<?php

declare(strict_types=1);

namespace Naneynonn\Enums;

enum GuildFeature: string
{
    case ANIMATED_BANNER = 'ANIMATED_BANNER';
    case ANIMATED_ICON = 'ANIMATED_ICON';
    case APPLICATION_COMMAND_PERMISSIONS_V2 = 'APPLICATION_COMMAND_PERMISSIONS_V2';
    case AUTO_MODERATION = 'AUTO_MODERATION';
    case BANNER = 'BANNER';
    case COMMUNITY = 'COMMUNITY';
    case CREATOR_MONETIZABLE_PROVISIONAL = 'CREATOR_MONETIZABLE_PROVISIONAL';
    case CREATOR_STORE_PAGE = 'CREATOR_STORE_PAGE';
    case DEVELOPER_SUPPORT_SERVER = 'DEVELOPER_SUPPORT_SERVER';
    case DISCOVERABLE = 'DISCOVERABLE';
    case FEATURABLE = 'FEATURABLE';
    case INVITES_DISABLED = 'INVITES_DISABLED';
    case INVITE_SPLASH = 'INVITE_SPLASH';
    case MEMBER_VERIFICATION_GATE_ENABLED = 'MEMBER_VERIFICATION_GATE_ENABLED';
    case MORE_STICKERS = 'MORE_STICKERS';
    case NEWS = 'NEWS';
    case PARTNERED = 'PARTNERED';
    case PREVIEW_ENABLED = 'PREVIEW_ENABLED';
    case ROLE_ICONS = 'ROLE_ICONS';
    case ROLE_SUBSCRIPTIONS_AVAILABLE_FOR_PURCHASE = 'ROLE_SUBSCRIPTIONS_AVAILABLE_FOR_PURCHASE';
    case ROLE_SUBSCRIPTIONS_ENABLED = 'ROLE_SUBSCRIPTIONS_ENABLED';
    case TICKETED_EVENTS_ENABLED = 'TICKETED_EVENTS_ENABLED';
    case VANITY_URL = 'VANITY_URL';
    case VERIFIED = 'VERIFIED';
    case VIP_REGIONS = 'VIP_REGIONS';
    case WELCOME_SCREEN_ENABLED = 'WELCOME_SCREEN_ENABLED';
}

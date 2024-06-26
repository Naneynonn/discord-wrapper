<?php

declare(strict_types=1);

namespace Naneynonn\Enums;

enum AuditLogEvents: int
{
    case GUILD_UPDATE = 1;
    case CHANNEL_CREATE = 10;
    case CHANNEL_UPDATE = 11;
    case CHANNEL_DELETE = 12;
    case CHANNEL_OVERWRITE_CREATE = 13;
    case CHANNEL_OVERWRITE_UPDATE = 14;
    case CHANNEL_OVERWRITE_DELETE = 15;
    case MEMBER_KICK = 20;
    case MEMBER_PRUNE = 21;
    case MEMBER_BAN_ADD = 22;
    case MEMBER_BAN_REMOVE = 23;
    case MEMBER_UPDATE = 24;
    case MEMBER_ROLE_UPDATE = 25;
    case MEMBER_MOVE = 26;
    case MEMBER_DISCONNECT = 27;
    case BOT_ADD = 28;
    case ROLE_CREATE = 30;
    case ROLE_UPDATE = 31;
    case ROLE_DELETE = 32;
    case INVITE_CREATE = 40;
    case INVITE_UPDATE = 41;
    case INVITE_DELETE = 42;
    case WEBHOOK_CREATE = 50;
    case WEBHOOK_UPDATE = 51;
    case WEBHOOK_DELETE = 52;
    case EMOJI_CREATE = 60;
    case EMOJI_UPDATE = 61;
    case EMOJI_DELETE = 62;
    case MESSAGE_DELETE = 72;
    case MESSAGE_BULK_DELETE = 73;
    case MESSAGE_PIN = 74;
    case MESSAGE_UNPIN = 75;
    case INTEGRATION_CREATE = 80;
    case INTEGRATION_UPDATE = 81;
    case INTEGRATION_DELETE = 82;
    case STAGE_INSTANCE_CREATE = 83;
    case STAGE_INSTANCE_UPDATE = 84;
    case STAGE_INSTANCE_DELETE = 85;
    case STICKER_CREATE = 90;
    case STICKER_UPDATE = 91;
    case STICKER_DELETE = 92;
    case GUILD_SCHEDULED_EVENT_CREATE = 100;
    case GUILD_SCHEDULED_EVENT_UPDATE = 101;
    case GUILD_SCHEDULED_EVENT_DELETE = 102;
    case THREAD_CREATE = 110;
    case THREAD_UPDATE = 111;
    case THREAD_DELETE = 112;
    case APPLICATION_COMMAND_PERMISSION_UPDATE = 121;
    case AUTO_MODERATION_RULE_CREATE = 140;
    case AUTO_MODERATION_RULE_UPDATE = 141;
    case AUTO_MODERATION_RULE_DELETE = 142;
    case AUTO_MODERATION_BLOCK_MESSAGE = 143;
    case AUTO_MODERATION_FLAG_TO_CHANNEL = 144;
    case AUTO_MODERATION_USER_COMMUNICATION_DISABLED = 145;
    case CREATOR_MONETIZATION_REQUEST_CREATED = 150;
    case CREATOR_MONETIZATION_TERMS_ACCEPTED = 151;
}

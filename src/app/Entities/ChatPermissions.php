<?php

namespace Romanlazko\Telegram\App\Entities;

/**
 * Class ChatPermissions
 *
 * @link https://core.telegram.org/bots/api#chatpermissions
 *
 * @method bool getCanSendMessages()       Optional. True, if the user is allowed to send text messages, contacts, locations and venues
 * @method bool getCanSendAudios()         Optional. True, if the user is allowed to send audios
 * @method bool getCanSendDocuments()      Optional. True, if the user is allowed to send documents
 * @method bool getCanSendPhotos()         Optional. True, if the user is allowed to send photos
 * @method bool getCanSendVideos()         Optional. True, if the user is allowed to send videos
 * @method bool getCanSendVideoNotes()     Optional. True, if the user is allowed to send video notes
 * @method bool getCanSendVoiceNotes()     Optional. True, if the user is allowed to send voice notes
 * @method bool getCanSendPolls()          Optional. True, if the user is allowed to send polls, implies can_send_messages
 * @method bool getCanSendOtherMessages()  Optional. True, if the user is allowed to send animations, games, stickers and use inline bots, implies can_send_media_messages
 * @method bool getCanAddWebPagePreviews() Optional. True, if the user is allowed to add web page previews to their messages, implies can_send_media_messages
 * @method bool getCanChangeInfo()         Optional. True, if the user is allowed to change the chat title, photo and other settings. Ignored in public supergroups
 * @method bool getCanInviteUsers()        Optional. True, if the user is allowed to invite new users to the chat
 * @method bool getCanPinMessages()        Optional. True, if the user is allowed to pin messages. Ignored in public supergroups
 * @method bool getCanManageTopics()       Optional. True, if the user is allowed to create forum topics. If omitted defaults to the value of can_pin_messages
 */
class ChatPermissions extends BaseEntity
{
    public static $map = [
        'can_send_messages'         => true,
        'can_send_audios'           => true,
        'can_send_documents'        => true,
        'can_send_photos'           => true,
        'can_send_videos'           => true,
        'can_send_video_notes'	    => true,
        'can_send_voice_notes'	    => true,
        'can_send_polls'            => true,
        'can_send_other_messages'   => true,
        'can_add_web_page_previews' => true,
        'can_change_info'           => true,
        'can_invite_users'          => true,
        'can_pin_messages'          => true,
        'can_manage_topics'         => true,
    ];
}
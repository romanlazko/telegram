<?php
namespace Romanlazko\Telegram\App\Entities;

use Romanlazko\Telegram\App\BotApi;
use Romanlazko\Telegram\App\Entities\BaseEntity;

class Result extends BaseEntity
{
    public static function fromRequest($data){
        if (is_array($data)) {
            if (self::isAssoc($data)) {
                return self::createResultObject($data);
            } 
            else{
                return self::createResultObjects($data);
            }
        }
    }

    protected static function isAssoc(array $array): bool
    {
        return count(array_filter(array_keys($array), 'is_string')) > 0;
    }

    private static function createResultObject(array $data): BaseEntity
    {
        $map = [
            'answerWebAppQuery'               => SentWebAppMessage::class,
            'getChat'                         => Chat::class,
            'getMyDefaultAdministratorRights' => ChatAdministratorRights::class,
            'getChatMember'                   => ChatMemberFactory::class,
            'getChatMenuButton'               => MenuButtonFactory::class,
            'getFile'                         => File::class,
            'getMe'                           => User::class,
            'getStickerSet'                   => StickerSet::class,
            'getUserProfilePhotos'            => UserProfilePhotos::class,
            'getWebhookInfo'                  => WebhookInfo::class,
            'editMessageReplyMarkup'          => EditedMessage::class,
        ];

        $action       = BotApi::getCurrentAction();
        $object_class = $map[$action] ?? Message::class;

        return $object_class::fromRequest($data);
    }

    private static function createResultObjects(array $results): array
    {
        $map = [
            'getMyCommands'         => BotCommand::class,
            'getChatAdministrators' => ChatMemberFactory::class,
            'getGameHighScores'     => GameHighScore::class,
            'sendMediaGroup'        => Message::class,
        ];

        $action       = BotApi::getCurrentAction();
        $object_class = $map[$action] ?? Update::class;

        $objects = [];

        foreach ($results as $result) {
            // We don't need to save the raw_data of the response object!
            $result['raw_data'] = null;

            $objects[] = $object_class::fromRequest($result);
        }

        return $objects;
    }
}
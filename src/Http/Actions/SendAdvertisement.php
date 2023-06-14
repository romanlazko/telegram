<?php 

namespace Romanlazko\Telegram\Http\Actions;

use Romanlazko\Telegram\App\Telegram;
use Romanlazko\Telegram\Models\Advertisement;

class SendAdvertisement 
{
    public function __invoke(Telegram $telegram, Advertisement $advertisement, int $chat_id)
    {
        if ($commandClass = $advertisement->command AND $advertisement->images()->count() == 0) {
            if (class_exists($commandClass)) {
                $buttons = $telegram::inlineKeyboard([
                    [array($commandClass::getTitle('ru'), $commandClass::$command, '')],
                ]);
            }
        }

        $text = implode("\n", [
            "*{$advertisement->title}*"."\n",
            $advertisement->description."\n"
        ]);

        $images = $advertisement->images->map(function($image){
            return asset($image->url);
        })->take(9);

        return $telegram::sendMessageWithMedia([
            'text'                      => $text,
            'chat_id'                   => $chat_id,
            'media'                     => $images ?? null,
            'parse_mode'                => 'Markdown',
            'disable_web_page_preview'  => $advertisement->web_page_preview,
            'reply_markup'              => $buttons ?? null,
        ]);
    }
}

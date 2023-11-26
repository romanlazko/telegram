<?php 

namespace Romanlazko\Telegram\Http\Actions;

use Romanlazko\Telegram\App\Bot;
use Romanlazko\Telegram\Models\Advertisement;

class SendAdvertisement 
{
    public function __invoke(Bot $bot, Advertisement $advertisement, int $chat_id)
    {
        $buttons = null;
        
        if ($advertisement->images()->count() == 0 AND $advertisement->command){
            $commands = explode(',', $advertisement->command);

            foreach ($commands as $commandClass) {
                if (class_exists($commandClass)) {
                    $buttons[] = [array($commandClass::getTitle('ru'), $commandClass::$command, '')];
                }
            }
            $buttons = $bot::inlineKeyboard($buttons);
        }

        $text = implode("\n", [
            "*{$advertisement->title}*"."\n",
            $advertisement->description."\n"
        ]);

        $images = $advertisement->images->map(function($image){
            return asset($image->url);
        })->take(9);

        return $bot::sendMessageWithMedia([
            'text'                      => $text,
            'chat_id'                   => $chat_id,
            'media'                     => $images ?? null,
            'parse_mode'                => 'Markdown',
            'disable_web_page_preview'  => $advertisement->web_page_preview,
            'reply_markup'              => $buttons ?? null,
        ]);
    }
}

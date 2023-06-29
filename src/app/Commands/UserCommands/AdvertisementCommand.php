<?php 
namespace Romanlazko\Telegram\App\Commands\UserCommands;

use Romanlazko\Telegram\App\BotApi;
use Romanlazko\Telegram\App\Commands\Command;
use Romanlazko\Telegram\App\Entities\Response;
use Romanlazko\Telegram\App\Entities\Update;
use Romanlazko\Telegram\Http\Actions\SendAdvertisement;
use Romanlazko\Telegram\Models\Advertisement;

class AdvertisementCommand extends Command
{
    public static $command = 'advertisement';

    public static $usage = ['advertisement'];

    protected $enabled = true;

    public function execute(Update $updates): Response
    {
        $advertisement  = Advertisement::where('is_active', '1')
            ->orderByAsc('updated_at')
            ->first();

        if (is_null($advertisement)) {
            return BotApi::emptyResponse();
        }

        $response = (new SendAdvertisement)($this->bot, $advertisement, $updates->getChat()->getId());

        $advertisement->increment('views');

        return $response;
    }
}

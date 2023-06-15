## Telegram package for Laravel

#### Install
- composer require romanlazko/telegram
- Add to app.config "Romanlazko\Telegram\Providers\TelegramServiceProvider::class"
- Add to User model trait Romanlazko\Telegram\Traits\TelegramBot
- Add to navigation.blade.php "\<\x-telegram::links/\>\"
- Add to Kernel 'telegram' => \Romanlazko\Telegram\Http\Middleware\Telegram::class,
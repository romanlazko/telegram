## Telegram Package for Laravel

#### Installation
- Run the command: `composer require romanlazko/telegram`
- Add the trait `Romanlazko\Telegram\Traits\HasBot` to the `User` model
- Add `<x-telegram::nav-links/>` to the `navigation.blade.php` file
- Add `<x-telegram::responsive-nav-links/>` to the `navigation.blade.php` file
- Add `'telegram' => \Romanlazko\Telegram\Http\Middleware\Telegram::class` to the Kernel,
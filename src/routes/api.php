<?php

use Illuminate\Support\Facades\Route;
use Romanlazko\Telegram\App\Telegram;
use Romanlazko\Telegram\App\TelegramLogDb;
use Romanlazko\Telegram\Exceptions\TelegramException;
use Romanlazko\Telegram\Models\TelegramBot;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::middleware(['api'])->prefix('api')->post('/telegram/{bot}', function (TelegramBot $bot) {
    try {
        (new Telegram($bot->token))->run();
    } 
    catch (TelegramException|\Exception|\Throwable|\Error $exception) {
        TelegramLogDb::report($bot->id, $exception);
    }
});

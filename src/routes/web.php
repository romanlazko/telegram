<?php

use Illuminate\Support\Facades\Route;
use Romanlazko\Telegram\Http\Controllers\TelegramAdvertisementController;
use Romanlazko\Telegram\Http\Controllers\TelegramController;
use Romanlazko\Telegram\Http\Controllers\TelegramChatController;
use Romanlazko\Telegram\Http\Controllers\GetContactController;
use Romanlazko\Telegram\Http\Controllers\MessageController;

Route::middleware(['web', 'auth'])->prefix('admin')->name('admin.')->group(function () {
    // Route::post('/switch/{telegram_bot}', [TelegramController::class, 'switch'])->name('bot.switch');

    // Route::middleware(['admin'])->group(function () {
        Route::resource('telegram_bot', TelegramController::class);
        Route::resource('telegram_bot.chat', TelegramChatController::class);
        Route::resource('telegram_bot.advertisement', TelegramAdvertisementController::class);
        Route::resource('telegram_bot.message', MessageController::class);

        // Route::middleware(['telegram:default'])->group(function () {
        //     Route::resource('chat', ChatController::class);

        //     Route::prefix('chat/{chat}')->group(function(){
        //         Route::get('/get-contact', GetContactController::class)->name('get-contact');
        //         Route::resource('message', MessageController::class);
        //     });
        
        //     Route::resource('advertisement', AdvertisementController::class);
        // });
    // });
});
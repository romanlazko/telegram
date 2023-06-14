<?php

use Illuminate\Support\Facades\Route;
use Romanlazko\Telegram\Http\Controllers\AdvertisementController;
use Romanlazko\Telegram\Http\Controllers\BotController;
use Romanlazko\Telegram\Http\Controllers\ChatController;
use Romanlazko\Telegram\Http\Controllers\GetContactController;
use Romanlazko\Telegram\Http\Controllers\MessageController;

Route::middleware(['web', 'auth'])->group(function () {
    Route::get('/switch/{user}', [BotController::class, 'switch'])->name('switch-account');
    Route::resource('bot', BotController::class);

    Route::middleware(['telegram:default'])->group(function () {
        Route::resource('chat', ChatController::class);

        Route::prefix('chat/{chat}')->group(function(){
            Route::get('/get-contact', GetContactController::class)->name('get-contact');
            Route::resource('message', MessageController::class);
        });
    
        Route::resource('advertisement', AdvertisementController::class);
    });

    
});
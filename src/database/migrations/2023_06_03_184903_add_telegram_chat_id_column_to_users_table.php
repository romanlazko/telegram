<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schema;
use Romanlazko\Telegram\Database\Seeders\UserSeeder;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->after('email', function ($table) {
                $table->unsignedBigInteger('telegram_chat_id')->nullable();
                $table->boolean('is_admin')->nullable();
            });
        });
    }
};

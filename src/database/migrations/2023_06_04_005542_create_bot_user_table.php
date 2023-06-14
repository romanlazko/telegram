<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Romanlazko\Telegram\Database\Seeders\UserSeeder;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Schema::create('bot_user', function (Blueprint $table) {
        //     $table->id();

        //     $table->unsignedBigInteger('user_id')->nullable();
        //     $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

        //     $table->unsignedBigInteger('bot_id')->nullable();
        //     $table->foreign('bot_id')->references('id')->on('bots')->onDelete('cascade');

        //     $table->timestamps();
        //     $table->softDeletes();
        // });
        $seeder = new UserSeeder();
        $seeder->call(UserSeeder::class);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_has_bots');
    }
};

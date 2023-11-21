<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('telegram_conversations', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user')->nullable();
            $table->index('user', 'conversation_user_idx');
            $table->foreign('user', 'conversation_user_fk')->on('telegram_users')->references('id');

            $table->json('notes')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('telegram_conversations');
    }
};

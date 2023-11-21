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
        Schema::create('telegram_callback_queries', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('callback_query_id')->nullable();

            $table->unsignedBigInteger('from')->nullable();
            $table->index('from', 'callback_querie_from_idx');
            $table->foreign('from', 'callback_querie_from_fk')->on('telegram_users')->references('id');

            $table->unsignedBigInteger('message')->nullable();
            $table->index('message', 'callback_querie_message_idx');
            $table->foreign('message', 'callback_querie_message_fk')->on('telegram_messages')->references('id');

            $table->string('inline_message_id')->nullable();

            $table->string('chat_instance')->nullable();

            $table->string('data')->nullable();

            $table->string('game_short_name')->nullable();

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
        Schema::dropIfExists('telegram_callback_queries');
    }
};

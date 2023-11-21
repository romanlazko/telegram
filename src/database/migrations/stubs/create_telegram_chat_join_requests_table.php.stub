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
        Schema::create('telegram_chat_join_requests', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('chat')->nullable();
            $table->index('chat', 'chat_join_request_chat_idx');
            $table->foreign('chat', 'chat_join_request_chat_fk')->on('telegram_chats')->references('id');
            
            $table->unsignedBigInteger('from')->nullable();
            $table->index('from', 'chat_join_request_from_idx');
            $table->foreign('from', 'chat_join_request_from_fk')->on('telegram_users')->references('id');

            $table->bigInteger('user_chat_id')->nullable();
            $table->bigInteger('date')->nullable();
            $table->string('bio')->nullable();
            $table->json('invite_link')->nullable();
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
        Schema::dropIfExists('telegram_chat_join_requests');
    }
};

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
        Schema::create('telegram_updates', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('bot_id')->nullable();
            $table->index('bot_id', 'update_bot_idx');
            $table->foreign('bot_id', 'update_bot_fk')->on('bots')->references('id');

            $table->bigInteger('update_id')->nullable();

            $table->unsignedBigInteger('chat')->nullable();
            $table->index('chat', 'update_chat_idx');
            $table->foreign('chat', 'update_chat_fk')->on('telegram_chats')->references('id');

            $table->unsignedBigInteger('message')->nullable();
            $table->index('message', 'update_message_idx');
            $table->foreign('message', 'update_message_fk')->on('telegram_messages')->references('id');

            $table->unsignedBigInteger('edited_message')->nullable();
            $table->index('edited_message', 'update_edited_message_idx');
            $table->foreign('edited_message', 'update_edited_message_fk')->on('telegram_messages')->references('id');

            $table->unsignedBigInteger('channel_post')->nullable();
            $table->index('channel_post', 'update_channel_post_idx');
            $table->foreign('channel_post', 'update_channel_post_fk')->on('telegram_messages')->references('id');

            $table->unsignedBigInteger('edited_channel_post')->nullable();
            $table->index('edited_channel_post', 'update_edited_channel_post_idx');
            $table->foreign('edited_channel_post', 'update_edited_channel_post_fk')->on('telegram_messages')->references('id');

            $table->unsignedBigInteger('inline_query')->nullable();

            $table->unsignedBigInteger('chosen_inline_result')->nullable();

            $table->unsignedBigInteger('callback_query')->nullable();
            $table->index('callback_query', 'update_callback_query_idx');
            $table->foreign('callback_query', 'update_callback_query_fk')->on('telegram_callback_queries')->references('id');

            $table->unsignedBigInteger('shipping_query')->nullable();

            $table->unsignedBigInteger('pre_checkout_query')->nullable();

            $table->unsignedBigInteger('poll')->nullable();

            $table->unsignedBigInteger('poll_answer')->nullable();

            $table->unsignedBigInteger('my_chat_member')->nullable();
            $table->index('my_chat_member', 'update_my_chat_member_idx');
            $table->foreign('my_chat_member', 'update_my_chat_member_fk')->on('telegram_chat_member_updates')->references('id');

            $table->unsignedBigInteger('chat_member')->nullable();
            $table->index('chat_member', 'update_chat_member_idx');
            $table->foreign('chat_member', 'update_chat_member_fk')->on('telegram_chat_member_updates')->references('id');

            $table->unsignedBigInteger('chat_join_request')->nullable();
            $table->index('chat_join_request', 'update_chat_join_request_idx');
            $table->foreign('chat_join_request', 'update_chat_join_request_fk')->on('telegram_chat_join_requests')->references('id');

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
        Schema::dropIfExists('telegram_updates');
    }
};

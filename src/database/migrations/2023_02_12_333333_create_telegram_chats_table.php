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
        Schema::create('telegram_chats', function (Blueprint $table) {
            $table->id();
            
            $table->unsignedBigInteger('bot_id')->nullable();
            $table->index('bot_id', 'chat_bot_idx');
            $table->foreign('bot_id', 'chat_bot_fk')->on('bots')->references('id');

            $table->bigInteger('chat_id')->nullable();
            $table->string('type')->nullable();
            $table->string('title')->nullable();
            $table->string('username')->nullable();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->boolean('is_forum')->nullable();
            $table->string('photo')->nullable();
            $table->string('role')->default('user');
            $table->json('active_usernames')->nullable();
            $table->string('emoji_status_custom_emoji_id')->nullable();
            $table->string('bio')->nullable();
            $table->boolean('has_private_forwards')->nullable();
            $table->boolean('has_restricted_voice_and_video_messages')->nullable();
            $table->boolean('join_to_send_messages')->nullable();
            $table->boolean('join_by_request')->nullable();
            $table->string('description')->nullable();
            $table->string('invite_link')->nullable();

            $table->unsignedBigInteger('pinned_message')->nullable();  
            $table->json('permissions')->nullable();
            $table->unsignedBigInteger('slow_mode_delay')->nullable();
            $table->bigInteger('message_auto_delete_time')->nullable();
            $table->boolean('has_aggressive_anti_spam_enabled')->nullable();
            $table->boolean('has_hidden_members')->nullable();
            $table->boolean('has_protected_content')->nullable();
            $table->string('sticker_set_name')->nullable();
            $table->boolean('can_set_sticker_set')->nullable();
            $table->unsignedBigInteger('linked_chat_id')->nullable();
            $table->json('location')->nullable();
            $table->unsignedBigInteger('referal_id')->nullable();
            $table->unsignedBigInteger('manager_id')->nullable();

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
        Schema::dropIfExists('telegram_chats');
    }
};

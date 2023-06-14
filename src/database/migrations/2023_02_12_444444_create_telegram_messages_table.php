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
        Schema::create('telegram_messages', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('message_id')->nullable();
            $table->bigInteger('message_thread_id')->nullable();

            $table->unsignedBigInteger('from')->nullable();
            $table->index('from', 'message_from_idx');
            $table->foreign('from', 'message_from_fk')->on('telegram_users')->references('id');

            $table->unsignedBigInteger('sender_chat')->nullable();
            $table->index('sender_chat', 'message_sender_chat_idx');
            $table->foreign('sender_chat', 'message_sender_chat_fk')->on('telegram_chats')->references('id');

            $table->bigInteger('date')->nullable();

            $table->unsignedBigInteger('chat')->nullable();   
            $table->index('chat', 'message_chat_idx');
            $table->foreign('chat', 'message_chat_fk')->on('telegram_chats')->references('id');

            $table->unsignedBigInteger('forward_from')->nullable();   
            $table->index('forward_from', 'message_forward_from_idx');
            $table->foreign('forward_from', 'message_forward_from_fk')->on('telegram_users')->references('id');

            $table->unsignedBigInteger('forward_from_chat')->nullable(); 
            $table->index('forward_from_chat', 'message_forward_from_chat_idx');
            $table->foreign('forward_from_chat', 'message_forward_from_chat_fk')->on('telegram_chats')->references('id');

            $table->unsignedBigInteger('forward_from_message_id')->nullable();           
            $table->string('forward_signature')->nullable();                 
            $table->string('forward_sender_name')->nullable();               
            $table->bigInteger('forward_date')->nullable();                      
            $table->boolean('is_topic_message')->nullable();                  
            $table->boolean('is_automatic_forward')->nullable();

            $table->unsignedBigInteger('reply_to_message')->nullable();
            $table->index('reply_to_message', 'message_reply_to_message_idx');
            $table->foreign('reply_to_message', 'message_reply_to_message_fk')->on('telegram_messages')->references('id');

            $table->unsignedBigInteger('via_bot')->nullable();
            $table->index('via_bot', 'message_via_bot_idx');
            $table->foreign('via_bot', 'message_via_bot_fk')->on('telegram_users')->references('id');
            
            $table->unsignedBigInteger('edit_date')->nullable();                         
            $table->boolean('has_protected_content')->nullable();             
            $table->string('media_group_id')->nullable();                    
            $table->string('author_signature')->nullable();                  
            $table->text('text')->nullable();                              
            $table->json('entities')->nullable();                      
            $table->json('animation')->nullable();                         
            $table->json('audio')->nullable();                             
            $table->json('document')->nullable();                         
            $table->string('photo')->nullable();                             
            $table->json('sticker')->nullable();                      
            $table->json('video')->nullable();
            $table->json('video_note')->nullable();
            $table->json('voice')->nullable();
            $table->text('caption')->nullable();
            $table->json('caption_entities')->nullable();                  
            $table->boolean('has_media_spoiler')->nullable();
            $table->json('contact')->nullable();                           
            $table->json('dice')->nullable();                              
            $table->json('game')->nullable();                              
            $table->json('poll')->nullable();                              
            $table->json('venue')->nullable();                             
            $table->json('location')->nullable();                          
            $table->json('new_chat_members')->nullable();

            $table->unsignedBigInteger('left_chat_member')->nullable();
            $table->index('left_chat_member', 'message_left_chat_member_idx');
            $table->foreign('left_chat_member', 'message_left_chat_member_fk')->on('telegram_users')->references('id');
            
            $table->text('new_chat_title')->nullable();                    
            $table->json('new_chat_photo')->nullable();                    
            $table->boolean('delete_chat_photo')->nullable();                 
            $table->boolean('group_chat_created')->nullable();                
            $table->boolean('supergroup_chat_created')->nullable();           
            $table->boolean('channel_chat_created')->nullable();              
            $table->bigInteger('message_auto_delete_timer_changed')->nullable(); 
            $table->bigInteger('migrate_to_chat_id')->nullable();                
            $table->bigInteger('migrate_from_chat_id')->nullable();

            $table->unsignedBigInteger('pinned_message')->nullable();
            $table->index('pinned_message', 'message_pinned_message_idx');
            $table->foreign('pinned_message', 'message_pinned_message_fk')->on('telegram_messages')->references('id');      
            // $table->bigInteger('invoice')->nullable();                           
            // $table->bigInteger('successful_payment')->nullable();                
            // $table->bigInteger('user_shared')->nullable();                       
            // $table->bigInteger('chat_shared')->nullable();                       
            $table->text('connected_website')->nullable();                 
            // $table->bigInteger('write_access_allowed')->nullable();              
            // $table->bigInteger('passport_data')->nullable();                     
            // $table->bigInteger('proximity_alert_triggered')->nullable();         
            // $table->bigInteger('forum_topic_created')->nullable();              
            // $table->bigInteger('forum_topic_edited')->nullable();                
            // $table->bigInteger('forum_topic_closed')->nullable();                
            // $table->bigInteger('forum_topic_reopened')->nullable();              
            // $table->bigInteger('general_forum_topic_hidden')->nullable();        
            // $table->bigInteger('general_forum_topic_unhidden')->nullable();      
            // $table->bigInteger('video_chat_scheduled')->nullable();              
            // $table->bigInteger('video_chat_started')->nullable();                
            // $table->bigInteger('video_chat_participants_invited')->nullable();
            // $table->bigInteger('web_app_data')->nullable();                   
            $table->json('reply_markup')->nullable();                   

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
        Schema::dropIfExists('telegram_messages');
    }
};

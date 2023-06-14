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
        Schema::create('telegram_users', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('bot_id')->nullable();
            $table->index('bot_id', 'telegram_user_bot_idx');
            $table->foreign('bot_id', 'telegram_user_id_fk')->on('bots')->references('id');

            $table->unsignedBigInteger('user_id');
            
            $table->boolean('is_bot')->default(false);
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('username')->nullable();
            $table->string('language_code')->nullable();
            
            $table->string('is_premium')->nullable();
            $table->string('added_to_attachment_menu')->nullable();
            $table->boolean('can_join_groups')->nullable();
            $table->boolean('can_read_all_group_messages')->nullable();
            $table->boolean('supports_inline_queries')->nullable();
            $table->string('expectation')->nullable();

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
        Schema::dropIfExists('telegram_users');
    }
};

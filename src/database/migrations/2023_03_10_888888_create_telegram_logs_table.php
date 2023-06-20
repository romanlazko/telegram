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
        Schema::create('telegram_logs', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('bot_id')->nullable();
            $table->index('bot_id', 'log_bot_idx');
            $table->foreign('bot_id', 'log_bot_fk')->on('bots')->references('id');
            
            $table->text('message')->nullable();
            $table->bigInteger('code')->nullable();
            $table->json('params')->nullable();
            $table->string('file')->nullable();
            $table->bigInteger('line')->nullable();
            $table->text('trace')->nullable();
            
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
        Schema::dropIfExists('telegram_logs');
    }
};

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

            $table->unsignedBigInteger('telegram_bot_id')->nullable();
            $table->foreign('telegram_bot_id')->on('telegram_bots')->references('id');
            
            $table->text('message')->nullable();
            $table->string('code')->nullable();
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

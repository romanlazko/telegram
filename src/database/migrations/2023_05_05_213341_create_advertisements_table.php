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
        Schema::create('advertisements', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('bot_id')->nullable();
            $table->index('bot_id', 'advertisement_bot_id_idx');
            $table->foreign('bot_id', 'advertisement_bot_id_fk')->on('bots')->references('id');

            $table->string('name')->nullable();
            $table->string('title')->nullable();
            $table->text('description')->nullable();
            $table->string('command')->nullable();
            $table->boolean('web_page_preview')->default(false);
            $table->bigInteger('views')->default(0);
            $table->boolean('is_active')->default(false);

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
        Schema::dropIfExists('advertisements');
    }
};

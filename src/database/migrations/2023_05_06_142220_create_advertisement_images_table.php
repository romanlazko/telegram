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
        Schema::create('advertisement_images', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('advertisement_id')->nullable();
            $table->index('advertisement_id', 'advertisement_image_advertisement_id_idx');
            $table->foreign('advertisement_id', 'advertisement_image_advertisement_id_fk')->on('advertisements')->references('id');

            $table->string('url')->nullable();
            
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
        Schema::dropIfExists('advertisement_images');
    }
};

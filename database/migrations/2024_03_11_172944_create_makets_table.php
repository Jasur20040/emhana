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
        Schema::create('makets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('type_id')->on('types')->cascadeOnDelete();
            $table->string('shablon_image');
            $table->string('maket_image');
            $table->string('title');
            $table->boolean('with_avatar');
            $table->json('avatar_sizes');
            $table->string('ava_image');
            $table->json('texts');
            $table->json('colors');
            $table->integer('price');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('makets');
    }
};

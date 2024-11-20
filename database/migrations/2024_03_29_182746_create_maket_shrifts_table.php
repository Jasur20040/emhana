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
        Schema::create('maket_shrifts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('maket_id')->constrained('makets')->onDelete('cascade');
            $table->foreignId('shrift_id')->constrained('shrifts')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('maket_shrifts');
    }
};

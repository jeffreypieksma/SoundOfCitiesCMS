<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTracksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tracks', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('audio_zones_id');
            $table->string('audio_url');
            $table->float('length')->nullable();
            $table->float('fadeinpoint')->nullable();
            $table->float('fadeoutpoint')->nullable();
            $table->float('volume')->nullable(); 
            $table->smallInteger('loopable')->nullable();

        });

        Schema::table('tracks', function (Blueprint $table) {
            $table->foreign('audio_zones_id')->references('id')->on('audio_zones')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tracks');
           
    }
}

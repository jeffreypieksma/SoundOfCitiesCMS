<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAudioZoneEffects extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('audio_zone_effects', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('audio_zone_id');
            $table->float('fadeinpoint')->nullable();
            $table->float('fadeoutpoint')->nullable();
            $table->float('volume'); 
            $table->smallInteger('loopable');
            $table->smallInteger('playonce');
        });

        Schema::table('audio_zone_effects', function (Blueprint $table) {
            $table->foreign('audio_zone_id')->references('id')->on('audio_zones')->onDelete('cascade');       
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('audio_zone_effects');
    }
}

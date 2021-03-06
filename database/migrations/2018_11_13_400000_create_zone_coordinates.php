<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateZoneCoordinates extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('zone_coordinates', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('audio_zones_id');
            $table->string('lat', 20);
            $table->string('lng', 20);       
        });

        Schema::table('zone_coordinates', function (Blueprint $table) {
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
        
        Schema::dropIfExists('zone_coordinates');
    }
}

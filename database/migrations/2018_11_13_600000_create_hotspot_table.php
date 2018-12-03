<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHotspotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hotspots', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('audio_zones_id');
            $table->string('title');
            $table->mediumText('description')->nullable();
            $table->string('image_url')->nullable();
        });

        Schema::table('hotspots', function (Blueprint $table) {
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
        Schema::dropIfExists('hotspots');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAudioZonesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('audio_zones', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('collection_id');
            $table->string('shape_type', 30);
            $table->string('radius', 30)->nullable();
            $table->string('label', 120)->nullable();        
            $table->string('color', 20)->nullable();
            $table->tinyInteger('visibility')->default(1);   

        });

        Schema::table('audio_zones', function (Blueprint $table) {
            $table->foreign('collection_id')->references('id')->on('zone_collections')->onDelete('cascade');       
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('audio_zones');
    }
}

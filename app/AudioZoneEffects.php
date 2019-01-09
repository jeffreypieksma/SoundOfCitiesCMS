<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AudioZoneEffects extends Model
{
    protected $table = 'audio_zone_effects';

    protected $fillable = ['track_id', 'audio_zone_id', 'fadeIn', 'fadeOut', 'volume', 'playonce', 'loopable'];

    public $timestamps = false;

    public function track()
    {
        return $this->belongsTo('App\Track');
    }

    public function audioZone() 
    {
        return $this->belongsTo('App\AudioZone');
    }

}
<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AudioZoneEffects extends Model
{
    protected $table = 'audio_zone_effect';

    protected $fillable = ['fadeIn', 'fadeOut', 'volume', 'playonce', 'loopable'];

    public $timestamps = false;

    public function track()
    {
        return $this->belongsTo('App\Tracks');
    }

}

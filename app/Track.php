<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Track extends Model
{
    protected $table = 'tracks';
    public $timestamps = false;
    protected $fillable = ['audio_url', 'name', 'length', 'fadeInPoints', 'FadeOutPoints', 'volume', 'play_once', 'loopable'];

    public function AudioZone()
    {
        return $this->belongsTo('App\AudioZone');
    }
    
    public function Collection()
    {
        return $this->belongsTo('App\Collection');
    }

    // public function AudioZoneEffects()
    // {
    //     return $this->hasMany('App\AudioZoneEffects', 'audio_zone_id');
    // }

    public function AudioZoneEffects()
    {
        return $this->belongsTo('App\AudioZoneEffects', 'audio_zone_id');
    }


}

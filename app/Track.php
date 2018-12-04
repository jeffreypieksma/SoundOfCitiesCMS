<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Track extends Model
{
    protected $table = 'tracks';
    public $timestamps = false;
    protected $fillable = ['length', 'fadeInPoints', 'FadeOutPoints', 'volume', 'play_once', 'loopable'];

    public function AudioZone()
    {
        return $this->belongsTo('App\AudioZone');
    }



}

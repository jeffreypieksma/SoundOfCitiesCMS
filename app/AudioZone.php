<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AudioZone extends Model
{

    protected $table = 'audio_zones';

    protected $fillable = ['shape', 'color', 'label', 'visibility'];

    public $timestamps = false;

    public function collection()
    {
        return $this->belongsTo('App\Collection');
    }

    public function zoneCoordinates()
    {
        return $this->hasMany('App\ZoneCoordinate', 'audio_zones_id');
    }

    public function hotspots()
    {
        return $this->hasMany('App\Hotspot');
    }

    public function tracks()
    {
        return $this->hasMany('App\Tracks');
    }

}

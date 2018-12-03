<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ZoneCoordinate extends Model
{
    protected $table = 'zone_coordinates';

    protected $fillable = ['lat', 'lon'];

    public function AudioZone()
    {
        return $this->belongsTo('App\AudioZone');
    }
}

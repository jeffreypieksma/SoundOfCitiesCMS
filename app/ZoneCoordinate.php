<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ZoneCoordinate extends Model
{
    protected $table = 'zone_coordinates';
    public $timestamps = false;

    protected $fillable = ['lat', 'lon'];

    public function audioZone()
    {
        return $this->belongsTo('App\AudioZone');
    }

}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hotspot extends Model
{
    protected $table = 'hotspots';
    public $timestamps = false;
    protected $fillable = ['title', 'description', 'image_url'];

    public function AudioZone()
    {
        return $this->belongsTo('App\AudioZone');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Collection extends Model
{
    protected $table = 'zone_collections';
    public $timestamps = false;
    protected $fillable = ['title', 'description', 'image_url'];
    
    //protected $guarded = ['user_id'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function audioZones()
    {
        return $this->hasMany('App\AudioZone');
    }
}

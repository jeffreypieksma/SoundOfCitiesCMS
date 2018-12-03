<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Collection extends Model
{
    protected $table = 'zone_collections';

    protected $fillable = ['title', 'description', 'image_url'];
    protected $guarded = ['user_id'];
}

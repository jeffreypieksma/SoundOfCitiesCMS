<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use Illuminate\Support\Facades\Auth; 
use Validator;
use App\Collection;
use App\AudioZone;

class AudioZoneController extends Controller
{
    public function create(Request $request){

        $validatedData = $request->validate([
            'type' => 'required',
            'center_point' => '',
            'coords' => '',
            'lat' => '',
            'lng' => '',
            'radius' => '',
            'center_point' => ''
        ]);

        $audioZone = new AudioZone;
        $audioZone->shape = $request->type;
        $audioZone->zone_collection_id = 3;    
        $audioZone->save();


    }
}
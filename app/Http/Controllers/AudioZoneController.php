<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use Illuminate\Support\Facades\Auth; 
use Validator;
use App\Collection;
use App\AudioZone;
use App\ZoneCoordinate;

class AudioZoneController extends Controller
{
    public function index() {
        $audioZone = AudioZone::with('zoneCoordinates')->get();
    }

    public function getZoneWithCoordinates($id) {
        $audioZone = AudioZone::find($id)->zoneCoordinates;
    }

    public function create(Request $request) {

        $validatedData = $request->validate([
            'zone.type' => 'required',
            'zone.center_point' => '',
            'zone.coords' => '',
            'zone.lat' => '',
            'zone.lng' => '',
            'zone.radius' => '',
            'zone.center_point' => ''
        ]);

        $audioZone = new AudioZone;
        $audioZone->zone_collection_id = 1;
        $audioZone->shape_type = $request->zone['type'];
        $coords = $request->zone['coords'];
        $audioZone->save();

        print_r($coords);

        $audioZone->zoneCoordinates()->create($coords);

        //$audioZone->zoneCoordinates()->create($coords);

        /*
            currently not working for circles 
        */

        // foreach($coords as $key => $value) {
        //     $zoneCoordinates = new ZoneCoordinate;
        //     $zoneCoordinates->audio_zones_id = $audioZone->id;

        //     $zoneCoordinates->lat = $value["lat"];
        //     $zoneCoordinates->lng = $value["lng"];

        //     $zoneCoordinates->save();
                 
        // }


    }

    public function update(){

    }

    public function delete(){

    }

}
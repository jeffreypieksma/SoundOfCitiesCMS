<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use App\User;
use Illuminate\Support\Facades\Auth; 
use Validator;
use App\Collection;
use App\AudioZone;
use App\ZoneCoordinate;
use DB;

class AudioZoneController extends Controller
{
    public function index() {
        $audioZone = AudioZone::with('zoneCoordinates')->get();
    }
    //Get collection with audio zones ands coordinates
    public function getAudioZones(Request $request, $id){
        return Collection::find($id)->audioZones;
    }

    public function getZoneWithCoordinates($id) {
        $audioZone = AudioZone::find($id)->zoneCoordinates;
    }

    public function create(Request $request) {
       
        // $validatedData = $request->validate([
        //     'zone.type' => 'required',
        //     'zone.center_point' => '',
        //     'zone.coords' => '',
        //     'zone.lat' => '',
        //     'zone.lng' => '',
        //     'zone.radius' => '',
        // ]);

        $audioZone = new AudioZone;
        //TO DO get current collection ID 
        $audioZone->collection_id = 1;
        $type =  $request->zone['type'];
        $audioZone->shape_type = $type;
        $coords = $request->zone['coords'];
        $audioZone->save();
    
        if($type==='circle'){
            $zoneCoordinates = new ZoneCoordinate;
            $zoneCoordinates->audio_zones_id = $audioZone->id;
            $zoneCoordinates->lat = $coords['lat'];
            $zoneCoordinates->lng = $coords['lng'];
            $zoneCoordinates->save();
        }else{
            foreach($coords as $key => $value) {
                $zoneCoordinates = new ZoneCoordinate;
                $zoneCoordinates->audio_zones_id = $audioZone->id;
    
                $zoneCoordinates->lat = $value["lat"];
                $zoneCoordinates->lng = $value["lng"];
    
                $zoneCoordinates->save();
                    
            }
        }
       
        return $audioZone;
        //return $audioZone;
        //$audioZone->zoneCoordinates()->create($coords);


    }

    public function update(){

    }

    public function delete(){

    }

}

// DB::transaction(function() {   
            
//     try {

//     } catch (QueryException $e) {   
//         DB::rollback();

//     }catch (\Exception $e) {
//         //Something else went wrong. 
//     }

// });
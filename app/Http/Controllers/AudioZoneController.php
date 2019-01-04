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
use App\Track;
use DB;
use Redirect;

class AudioZoneController extends Controller
{
    /*
        @parm id = collection_id
    */
    public function getZoneWithCoordinates($id) {
        $audioZone = AudioZone::find($id)->zoneCoordinates;
    }

    /*
        Get collection with audio zones ands coordinates
        @parm =  collection_id 
    */
    public function getCollectionWithAudioZones($id) {
        $audioZones = Collection::findOrFail($id)->audioZones;
        
        foreach( $audioZones as $audioZone ){
            $coords = AudioZone::find($audioZone->id)->zoneCoordinates;
            $audioZone['coords'] = $coords;
        }
        return $audioZones;
    }

    public function createZones(Request $request) {
        $audioZones = $request->audioZones;


        if( count($audioZones) > 0 ) {

            $validatedData = $request->validate([
                'audioZones.collection_id.*' => 'required|integer',
                'audioZones.type.*' => 'required|string',
                'audioZones.layer.*' => 'required|string',
                'zone.audioZones.coords.*' => 'required|array',
            ]);
            
            foreach($audioZones as $zone) {
                $audioZone = new AudioZone;
                $audioZone->collection_id =  $zone['collection_id'];
                $audioZone->shape_type = $zone['type'];
                $audioZone->radius = $zone['radius'];
                $audioZone->label = $zone['label'];
                $audioZone->color = $zone['color'];
                $audioZone->visibility = $zone['visibility'];
                $audioZone->save();
        
                $coords = $zone['coords'];

                if ( $zone['type'] == 'circle' ) {

                    $zoneCoordinates = new ZoneCoordinate;
                    $zoneCoordinates->audio_zones_id = $audioZone->id;

                    $zoneCoordinates->lat = $coords['lat'];
                    $zoneCoordinates->lng = $coords['lng'];
                    $zoneCoordinates->save();

                } else {
                    foreach ( $coords as $key => $value ) { 
                        foreach ( $value as $v ){
                            $zoneCoordinates = new ZoneCoordinate;
                            $zoneCoordinates->audio_zones_id = $audioZone->id;
                            $zoneCoordinates->lat = $v["lat"];
                            $zoneCoordinates->lng = $v["lng"];

                            $zoneCoordinates->save();
                        }                      
                    }      
                }
            }
           // return redirect('dashboard')->with('status', 'Profile updated!');

            return redirect()->route('map', [$zone['collection_id']])->with('status', 'Updated map');
        }
    }

    /*
        Old 
    */
    // public function create(Request $request) {
       
    //     $validatedData = $request->validate([
    //         'zone.type' => 'required|string',
    //         'zone.collection_id' => 'required|integer',
    //     ]);

    //     $audioZone = new AudioZone;
    //     $audioZone->collection_id = $request->zone['collection_id'];
    //     $type =  $request->zone['type'];
    //     $audioZone->shape_type = $type;
    //     $coords = $request->zone['coords'];
    //     $audioZone->save();
    
    //     if($type==='circle'){
    //         $zoneCoordinates = new ZoneCoordinate;
    //         $zoneCoordinates->audio_zones_id = $audioZone->id;
    //         $zoneCoordinates->lat = $coords['lat'];
    //         $zoneCoordinates->lng = $coords['lng'];
    //         $zoneCoordinates->save();
    //     }else{
    //         foreach($coords as $key => $value) {
    //             $zoneCoordinates = new ZoneCoordinate;
    //             $zoneCoordinates->audio_zones_id = $audioZone->id;
    
    //             $zoneCoordinates->lat = $value["lat"];
    //             $zoneCoordinates->lng = $value["lng"];
    
    //             $zoneCoordinates->save();
                    
    //         }
    //     }
       
    //     return $audioZone;
    //     //return $audioZone;
    //     //$audioZone->zoneCoordinates()->create($coords);


    // }

    public function update() {

    }

    public function delete() {

    }

}
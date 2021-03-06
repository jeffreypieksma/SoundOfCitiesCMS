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

class AudioZoneController extends Controller {
    /*
        @parm id = collection id
    */
    public function getZoneWithCoordinates($id) {
        $audioZone = AudioZone::find($id)->zoneCoordinates;
    }

    /*
        @parm =  collection id
        Get collection with audio zones ands coordinates    
    */
    public function getCollectionWithAudioZones($id) {
        $audioZones = Collection::findOrFail($id)->audioZones;
        
        foreach( $audioZones as $audioZone ){
            $coords = AudioZone::find($audioZone->id)->zoneCoordinates;
            $audioZone['coords'] = $coords;
        }
        return $audioZones;
    }

    /*
        @ToDo page refresh after succesfull creation & test validation response  
    */
    public function createZones(Request $request) {
        $audioZones = $request->audioZones;

        if( count($audioZones) > 0 ) {

            $validator = Validator::make($request->all(), [
                'audioZones.collection_id.*' => 'required|integer',
                'audioZones.type.*' => 'required|string',
                'audioZones.layer.*' => 'required|string',
                'zone.audioZones.coords.*' => 'required|array',
            ]);

            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            } else { 
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
            }   
        }
        return response()->json('succes', 200);
             

        //return redirect()->route('map', [$zone['collection_id']])->with('status', 'Updated map');

    }

    /*
        @Todo delete audio files and relations
        Delete AudioZone with zoneCoordinates, AudioEffects and tracks. 
    */
    public function delete(Request $request) {
        $id = $request->id;

        $audioZone = AudioZone::destroy($id);

        if($audioZone) {
            return response()->json('succes', 200);
        }else{
            return response()->json('Error', 500);
        }

    }

}
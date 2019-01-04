<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth; 
use Validator;
use DB;

use App\AudioZoneEffects;
use App\Track;
use App\User;
use App\Collection;
use App\AudioZone;


class AudioController extends Controller
{
    
    /*
        @todo check audio files 
    **/
    public function addEffectsToAudio(Request $request) {
        
        $data = $request['data'];

        $validator = Validator::make($request->all(), [
            'data.track_id' => 'required|integer',
            'data.audio_zone_id' => 'required|integer',
            'data.fadeIn' => 'numeric|integer',
            'data.fadeOut' => 'numeric|integer',
            'data.playonce' => 'boolean',
            'data.loopable' => 'boolean',
            'data.volume' => 'numeric|integer'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
            //return redirect()->back()->withErrors($validator)->withInput();
        }else{
            //If there's a model matching the audio_zone_id update the model. 
            //if no matching model excists, create one.      
            $audioZoneEffect = AudioZoneEffects::updateOrCreate(
                ['audio_zone_id' => $data['audio_zone_id']],
                [
                    'track_id' => $data['track_id'],
                    'audio_zone_id' => $data['audio_zone_id'],
                    'fadeIn' => $data['fadeIn'],
                    'fadeOut' =>  $data['fadeOut'],
                    'playonce' => $data['playonce'],
                    'loopable' => $data['loopable'],
                    'volume' => $data['volumeControl'],
    
                ]
            );
        }     
        
    }

    public function getAudioEffect($id) {
        return AudioZoneEffects::whereAudio_zone_id($id)->first();
    }

}

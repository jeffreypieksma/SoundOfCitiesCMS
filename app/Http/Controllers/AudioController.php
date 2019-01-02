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
    
    public function addEffectsToAudio(Request $request) {
        
        $data = $request['data'];
        //Needs more testing
        $validatedData = $request->validate([
            'data.track_id' => 'required|integer',
            'data.audio_zone_id' => 'required|integer',
            'data.fadeIn' => 'numeric|integer',
            'data.fadeOut' => 'numeric|integer',
            'data.playonce' => 'boolean',
            'data.loopable' => 'boolean',
            'data.volume' => 'numeric|integer'
        ]);  
        
        
        //If there's a model matching the audio_zone_id update the model. 
        //if no matching model excists, create one. 
        
        $audioZoneEffect = AudioZoneEffects::updateOrCreate(
            [
                'audio_zone_id' => $data['audio_zone_id']
            ],
            [
                'track_id' => $data['track_id'],
                'audio_zone_id' => $data['audio_zone_id'],
                'fadeIn' => $data['fadeIn'],
                'fadeOut' =>  $data['fadeOut'],
                'playonce' => $data['playonce'],
                'loopable' => $data['loopable'],
                'volume' => $data['volumeControl']
            ]
        );

    }
}

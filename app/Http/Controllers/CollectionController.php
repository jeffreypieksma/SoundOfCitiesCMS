<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;

use App\User;
use Validator;
use App\Collection;
use App\Track;
use App\AudioZone;
use App\AudioZoneEffects;
use ZipArchive;


class CollectionController extends Controller
{
    // public function __construct() {
    //     \App::setLocale('en');
    // }

    public function index(){
        $user = Auth::user(['id','name','email']);
        $userID = Auth::id();

        $collections = Collection::where('user_id', $userID)
            ->orderBy('created_at', 'desc')
            ->take(10)
            ->paginate(10);   
        
        return view('collection.index', compact('collections','user'));
    }

    
    public function updateForm($id) {
        $collection = Collection::findOrFail($id);

        return view('collection.update', compact('collection'));
    }

    /*
        Get all collections from logged in user and return this to the view 
    */
    public function createForm() {
        $user = Auth::user(['id','name','email']);
        $userID = Auth::id();
        return view('collection.create', compact('user'));
    }

    /*
        @param = collection_id
        return = collection with audio zones and files 
    */
    public function dashboardView($id) {
        $userID = Auth::id();

        $check = Collection::whereUser_id($userID)->get();

        if ($check->isEmpty()) {
            abort(403, 'Unauthorized action');
        } else {
            $collection = Collection::find($id);
            $audioFiles = Track::whereCollection_id($id)->get();
            $audioZones = Collection::find($id)->audioZones;

            return View('dashboard', compact('collection','audioZones', 'audioFiles'));
        }


    }

    public function getCollectionWithAudioZones() {
        $audioZones = Collection::find($id)->audioZones;
        return $audioZones;
    }
    
    public function create(Request $request) {
        $user = Auth::user(['id','name','email']);
        $userID = Auth::id();

        /*
            @ToDo Audio array validation (mimeType: mp3 and wav)
        */
        $validatedData = $request->validate([
            'title' => 'required|max:256',
            'description' => 'max:5000',
            'audio' => 'required',
        ]);

    
        $collection = new Collection;
        
        $collection->user_id = $userID;
        $collection->title = $request->title;
        $collection->description = $request->description;
        $collection->save();
        $collection_id = $collection->id;

        $files = $request->file('audio');

        if($request->hasFile('audio')) {
            foreach ($files as $file) {
                $randomString = md5(microtime());
                $filename = $file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension();
                $name = $randomString . '.' . $extension;

                $path = $file->storeAs('audio', $name);

                $track = new Track;
                $track->name = $filename;
                $track->collection_id = $collection_id;
                $track->audio_url = $path;
                $track->save();
            }
        }

        if($validatedData) {
            return redirect()->route('collections');
        }
    
    }

    /*
        @Todo Audio array validation (mimeType: mp3 and wav) If theres a audio files remove the old files. 
    */

    public function update(Request $request) {

        $validatedData = $request->validate([
            'id' => 'required|integer',
            'title' => 'required|max:256',
            'description' => 'max:5000',
        ]);

        $collection_id = $request->id;
        
        $collection = Collection::findOrFail($collection_id);
        $collection->title = $request->title;
        $collection->description = $request->description;  

        $files = $request->file('audio');
        
        if($request->hasFile('audio')) {
            foreach ($files as $file) {
                $randomString = md5(microtime());
                $filename = $file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension();
                $name = $randomString . '.' . $extension;

                $path = $file->storeAs('audio', $name);

                $track = new Track;
                $track->name = $filename;
                $track->collection_id = $collection_id;
                $track->audio_url = $path;
                $track->save();
            }
        }

        $collection->save();

        if($validatedData) {
            return redirect()->route('collections');
        }
    }

    /*
        @param = collection_id
        Export al the collection data with audiozones and files to ZIP. 

        1. Collection
        2. AudioZones
        3. AudioZone coordinates
        4. AudioZoneEffects
        5. tracks 
    */
    public function export($id) {
        
        $audioZones = Collection::findOrFail($id)->audioZones;
        $folder = 'collection_'. $id;
        
        foreach( $audioZones as $audioZone ) {
            $coords = AudioZone::find($audioZone->id)->zoneCoordinates;
            $audioZone['coords'] = $coords;
            
            $audioZoneEffect = AudioZone::find($audioZone->id)->audioZoneEffects;
            
            if(count($audioZoneEffect) > 0 ) {

                $track_id = $audioZoneEffect[0]->track_id;
                $track = Track::find($track_id);   
                $filename = $track->name;
                $audio_url = $track->audio_url;

                /* Add effects and tracks to the audioZone */
                $audioZone['effects'] = $audioZoneEffect;
                $audioZone['tracks'] = $track;

                /* Check the collection folder and copy this to the public folder */
                $exists = Storage::disk('local')->exists("{$folder}/{$audio_url}");
                if(!$exists) { 
                    Storage::copy("{$audio_url}", "{$folder}/{$audio_url}");
                }
            }    
        } 

        Storage::disk('local')->makeDirectory($folder);
        Storage::disk('local')->put($folder.'/audioZones.json', json_encode($audioZones));

        $url = "app/{$folder}/*";

        $files = glob(storage_path($url));
        \Zipper::make("{$folder}.zip")->add($files)->close();

        if(file_exists(public_path("{$folder}.zip"))) {
            return response()->download(public_path("{$folder}.zip"));
        }

    }
}
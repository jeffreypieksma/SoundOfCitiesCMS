<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\User;
use Illuminate\Support\Facades\Auth;
use Validator;
use App\Collection;
use App\Track;

use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;

class CollectionController extends Controller
{
    public function __construct() {
        \App::setLocale('en');
    }

    public function index(){
        $user = Auth::user(['id','name','email']);
        $userID = Auth::id();

        $collections = Collection::where('user_id', $userID)
            ->orderBy('created_at', 'desc')
            ->take(10)
            ->paginate(10);   
        
        return view('collection.index', compact('collections','user'));
    }

    
    public function updateForm($id){
        //to DO Get audio files 
        $collection = Collection::findOrFail($id);

        return view('collection.update', compact('collection'));
    }

    /* Get all collections from logged in user and return this to the view */
    public function createForm(){
        $user = Auth::user(['id','name','email']);
        $userID = Auth::id();
        return view('collection.create', compact('user'));
    }
    /*
        @param = collection_id
        return = collection with audio zones and files 
    */
    public function dashboardView($id){
        $collection = Collection::find($id);
        //to do check collection with user id 
        $audioFiles = Track::whereCollection_id($id)->get();
        $audioZones = Collection::find($id)->audioZones;
        return View('dashboard', compact('collection','audioZones', 'audioFiles'));
    }

    public function getCollectionWithAudioZones(){
        $audioZones = Collection::find($id)->audioZones;
        return $audioZones;
    }
    
    public function create(Request $request){
        $user = Auth::user(['id','name','email']);
        $userID = Auth::id();

        $validatedData = $request->validate([
            'title' => 'required|max:256',
            'description' => 'required|max:5000',
            //'audioFiles.*' => 'required|audio/mpeg,mpga,mp3,wav|max:20000',
        ]);

    
        $collection = new Collection;
        
        $collection->user_id = $userID;
        $collection->title = $request->title;
        $collection->description = $request->description;
        $collection->image_url = 'test';    
        $collection->save();
        $collection_id = $collection->id;

        $files = $request->file('audio');
        if($request->hasFile('audio'))
        {
            foreach ($files as $file) {
                $filename = $file->getClientOriginalName();
                $name = $collection_id. '_' .$filename;

                $path = $file->storeAs('audio', $name);

                $track = new Track;
                $track->collection_id = $collection_id;
                $track->audio_url = $path;
                $track->save();
            }
        }

        if($validatedData){
            return redirect()->route('collections');
        }
     
       
    }
}
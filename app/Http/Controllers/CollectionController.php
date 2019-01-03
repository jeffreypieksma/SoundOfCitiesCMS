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
                $filename = $file->getClientOriginalName();
                $name = $collection_id. '_' .$filename;

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

    public function update(Request $request) {

        /*
            @Todo 
            Audio array validation (mimeType: mp3 and wav) 
            If theres a audio files remove the old files. 
        */

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
                $filename = $file->getClientOriginalName();
                $name = $collection_id. '_' .$filename;

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
}
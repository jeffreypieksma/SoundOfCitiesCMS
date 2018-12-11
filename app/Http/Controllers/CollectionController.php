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

    public function index(){
        
    }

    /* Get all collections from logged in user and return this to the view */
    public function createForm(){
        $user = \Auth::user()->first(['id','name','email']);
        
        if(!$user){
            abort(403, 'Unauthorized action.');
        }else{

            $collections = Collection::where('user_id', $user->id)
               ->orderBy('created_at', 'desc')
               ->take(10)
               ->paginate(10);   
        }
        
        return view('collection.create_collection_form', compact('collections','user'));
       
    }
    
    public function create(Request $request){

        $validatedData = $request->validate([
            'title' => 'required|max:256',
            'description' => 'required|5000',
            //'audioFiles.*' => 'required|audio/mpeg,mpga,mp3,wav|max:20000',
        ]);

    
        $collection = new Collection;
        $collection->user_id = \Auth::user()->id;
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

                $path = $file->storeAs(
                    'audio', $name
                );

                $track = new Track;
                $track->collection_id = $collection_id;
                $track->audio_url = $path;
                $track->save();
            }
        }
     
        return redirect()->route('create_collection_form');
    }
}
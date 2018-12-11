<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\User;
use Illuminate\Support\Facades\Auth; 
use Validator;
use App\Collection;

class CollectionController extends Controller
{

    public function index(){
        
    }

    /* Get all collections from logged in user and return this to the view */
    public function createForm(){
        $user = \Auth::user()->first(['id','name','email']);
        $collections = Collection::Find($user->id)->get();
 
       return view('collection.create_collection_form', compact('collections','user'));
    }
    
    public function create(Request $request){
       
        $validatedData = $request->validate([
            'title' => 'required|max:256',
            'description' => '',
        ]);

        foreach ($request->audioFiles as $file) {
            $filename = $file->store('audioFiles');
            ProductsPhoto::create([
                'product_id' => $product->id,
                'filename' => $filename
            ]);
        }
        return 'Upload successful!';

        $collection = new Collection;
        $collection->user_id = \Auth::user()->id;
        $collection->title = $request->title;
        $collection->description = $request->description;
        $collection->image_url = 'test';    
        $collection->save();
     
        return redirect()->route('create_collection_form');
    }
}
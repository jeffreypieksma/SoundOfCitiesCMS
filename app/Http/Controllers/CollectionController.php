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
    public function create(Request $request){
        
        $validatedData = $request->validate([
            'title' => 'required|max:256',
            'description' => '',
        ]);

        $collection = new Collection;
        $collection->user_id = \Auth::user()->id;
        $collection->title = $request->title;
        $collection->description = $request->description;
        $collection->image_url = 'test';    
        $collection->save();
    }
}
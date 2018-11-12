<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\User;
use \Crypt;
use Illuminate\Support\Facades\Auth; 
use Validator;

class UserController extends Controller
{

  public function index()
  {
    $users = User::all();

    return view('admin.users.index', compact('users'));
  }
  
  public function getUserDetails(Request $request){
    $id = $request->user_id;
    $user = User::find($id);
    if($user){
      return \Response::json([
        'user' => $user
      ], 200 );
    }else{
      return response('User not found', 401);
    }
  }

  public function logout(){
    //POST
  }

  public function create_user_form()
  {
    return view('admin.users.create');
  }

  public function create(Request $request)
  {
  	$user = new user(); 

  	$this->validate($request, [
        'name' => 'required|max:30',
        'email' => 'required|email|max:255|unique:users',
        'role'  => 'required|numeric',
        'password' => 'required|min:6',
        'password_confirm' => 'required|same:password',
    ]);

    $user->name = $request->name;
    $user->email = $request->email;
    $user->role = $request->role;
    //Set role as admin
    if($user->role == 2) $user->is_admin = 1;
    //Encrypt password with laravel bcrypt    
    $user->password = bcrypt($request->password);
    $user->save();

    if(!$user->save()) App::abort(500, 'Error');    

    Session::flash('message', 'Gebruiker aangemaakt!');
    return redirect()->route('admin_users');
  }

  public function update_user_form($id)
  {
    $user = User::findOrFail($id);   
    return view('admin.users.update', compact('user'));
  }

  public function update(Request $request)
  {
    $user = User::find($request->id); 

    if(!isset($request->password)){
      $user->password = bcrypt($request->password);
      $this->validate($request, [
        'name' => 'required|max:30',
        'email' => 'required|email|max:255',
        'role'  => 'required|numeric',
      ]);
    }else{
      $this->validate($request, [
        'name' => 'required|max:30',
        'email' => 'required|email|max:255',
        'role'  => 'required|numeric',
        'password' => 'required|min:6',
        'password_confirm' => 'required|same:password',
      ]);
    }
    $user->name = $request->name;
    $user->email = $request->email;
    if($user->role == 2) $user->is_admin = 1;  
    $user->role = $request->role;
    $user->save();

    Session::flash('message', 'Gebruiker gewijzigd!');
    return redirect()->route('admin_users');
  }

  public function delete($id)
  {
    $user = User::find($id); 
    $user->delete();

    Session::flash('message', 'Gebruiker verwijderd!');
    return redirect()->route('admin_users');
  }

}

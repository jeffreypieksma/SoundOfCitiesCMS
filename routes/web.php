<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('home');
});

Route::get('logout', function (){
	Auth::logout();
	return redirect('/login');
});

//Collection
Route::post('/collection/create', 'CollectionController@create')->name('create_collection');
Route::get('/collection/create', 'CollectionController@createForm')->name('create_collection_form');
Route::get('/collection', 'CollectionController@index')->name('collections');
Route::put('/collection', 'CollectionController@update')->name('update_collections');
Route::delete('/collection', 'CollectionController@delete')->name('delete_collections');

//AudioZone
Route::post('/audioZone/create', 'AudioZoneController@create')->name('create_audioZone');
//Route::get('/audioZone', 'AudioZoneController@index')->name('audioZone');
Route::put('/audioZone', 'AudioZoneController@update')->name('update_audioZone');
Route::delete('/audioZone', 'AudioZoneController@delete')->name('delete_audioZone');

//Upload audio 


Route::group(['prefix' => 'admin', 'middleware' => ['web'] ], function () {

	Route::get('/', 'DashboardController@index')->name('dashboard');
	Route::get('dashboard', 'DashboardController@index')->name('dashboard');
    //list users
	Route::get('/users', 'UserController@index')->name('users');

	Route::get('/user/create', 'UserController@create_user_form')->name('create_user_form');
	Route::post('/user/create', 'UserController@create')->name('create_user');
	Route::get('/users', 'UserController@index')->name('admin_users');
	Route::get('/user/read/{id}', 'UserController@read')->name('read_user');
	Route::get('/user/update/{id}', 'UserController@update_user_form')->name('update_user_form');
	Route::post('/user/update', 'UserController@update')->name('update_user');
	Route::get('/user/delete/{id}', 'UserController@delete')->name('delete_user');

	
});

Auth::routes();
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




Route::group(['middleware' => 'checkStatus'], function () {

	Route::get('/', function () {
		return view('welcome');
	});

	Route::get('/sources', function () {
		return view('sources');
	});

	Route::post('update_source', 'UserInfoController@updateSources');
	Route::post('get_sources', 'UserInfoController@getSources');
});


Route::get('auth', function () {
	return view('login');
})->name('auth')->middleware('checkLogged');

Route::get('set_account', function () {
	return view('set_account');
})->middleware('filledAccount');


Route::post('set_account', 'UserInfoController@finishregistration')->middleware('filledAccount');



Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');



Route::get('/confirm/{email}/key/{key}', 'AuthController@activation');


Route::post('registration','AuthController@registration');
Route::post('login','AuthController@login');



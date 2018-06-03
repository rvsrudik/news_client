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
    return view('welcome');
});


Route::get('mail', function () {

	Mail::to("intrudenko@gmail.com")->send(new App\Mail\RegistrationConfirm('1', '12', '23'), ['name'=> 'vitalii', 'email' => 'rvsdf@sdf.com', 'key' => 'asdasdasdas']);

});




Route::get('auth', function () {
	return view('login');
});


Route::get('auth2','AuthController@new_user1');



Route::post('registration','AuthController@registration');

Route::get('/confirm/{email}/key/{key}', 'AuthController@activation');

<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/user/checkin','BackendController@checkin');
Route::post('/user/checkout','BackendController@checkout');
Route::post('/user/attendance','BackendController@getAttendance');
Route::post('/user/login','BackendController@login');

Route::get('/user/create',function (){
    \App\User::create(['name'=>'Webs','email'=>'webs@gmail.com','password'=>bcrypt('password')]);
});

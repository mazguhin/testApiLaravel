<?php

use Illuminate\Http\Request;

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('/token','AuthenticateController@index')->middleware('cors');
Route::post('/reg','AuthenticateController@create')->middleware('cors');

Route::get('/points','PointsController@index')->middleware('jwt.auth','cors');
Route::post('/points','PointsController@update')->middleware('jwt.auth','cors');

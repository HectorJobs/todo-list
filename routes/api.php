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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('cors')->group(function() {
    Route::get('/complexities', 'ComplexityController@index');
    Route::post('/store/complexity', 'ComplexityController@store');
    Route::post('/update/complexity', 'ComplexityController@update');
    Route::post('/delete/complexity', 'ComplexityController@destroy');

    Route::get('/progress', 'ProgressController@index');
    Route::post('/store/progress', 'ProgressController@store');
    Route::post('/update/progress', 'ProgressController@update');
    Route::post('/delete/progress', 'ProgressController@destroy');

    Route::get('/works', 'WorkController@index');
    Route::post('/store/works', 'WorkController@store');
    Route::post('/update/works', 'WorkController@update');
    Route::post('/delete/works', 'WorkController@destroy');
});
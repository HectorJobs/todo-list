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
    Route::put('/update/complexity', 'ComplexityController@update');
    Route::delete('/delete/complexity', 'ComplexityController@destroy');

    Route::get('/progress', 'ProgressController@index');
    Route::post('/store/progress', 'ProgressController@store');
    Route::put('/update/progress', 'ProgressController@update');
    Route::delete('/delete/progress', 'ProgressController@destroy');

    Route::get('/works', 'WorkController@index');
    Route::post('/store/works', 'WorkController@store');
    Route::put('/update/works', 'WorkController@update');
    Route::delete('/delete/works', 'WorkController@destroy');
});
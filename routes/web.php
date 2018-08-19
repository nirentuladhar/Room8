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


/**
 * Authentication Routes
 */
Auth::routes();


/**
 * PUBLIC ROUTES
 */

Route::group(['middleware' => ['web']], function(){
    # /
    Route::get('/','PublicController@index')->name('public.index');
    
});


/**
 * ROUTES REQUIRING AUTHENTICATION
 */

 Route::group(['middleware' => ['auth']], function(){

 });





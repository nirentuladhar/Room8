<?php

use Illuminate\Http\Request;
use App\User;
use App\House;


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

/**
 * Types of errors
 * syntax : ['error'=>'error_type']
 * 
 * ERROR TYPE               |       MEANING
 * ________________________________________________________________________________________________________
 * TOKEN_INVALID            ->  JWT token is invalid
 * TOKEN_EXPIRED            ->  JWT token is used after its expires_in time
 * TOKEN_BLACKLISTED        ->  JWT token is blacklisted and have to fetch a new one by logging in again
 * 
 * UNAUTHORIZED_REQUEST     ->  The request is unauthorized (No token used)
 * 
 * MODEL_NOT_FOUND          ->  Model not found for the id
 * URL_NOT_FOUND            ->  URL is invalid (It is not handled in api.php)
 */



/**
 * Authentication Routes
 */
Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {

    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');
});


Route::group(['namespace' => 'API', 'middleware' => ['api', 'jwt.auth']], function ($router) {

    /**
     * User Routes
     */
    Route::get('/users', 'UserController@index')->name('users.index');
    Route::post('/users', 'UserController@store')->name('users.store');
    Route::delete('/users/{user}', 'UserController@destroy')->name('users.destroy');
    Route::match(array('PUT', 'PATCH'), "/users/{user}", array(
        'uses' => 'UserController@update',
        'as' => 'users.update'
    ));
    Route::get('/users/{user}', 'UserController@show')->name('users.show');
    Route::get('/users/{user}/houses', 'UserController@allHouses')->name('users.houses');
    Route::get('/users/{user}/groups', 'UserController@allGroups')->name('users.groups');

    /**
     * House Routes
     */
    Route::get('/houses', 'HouseController@index')->name('houses.index');
    Route::post('/houses', 'HouseController@store')->name('houses.store');
    Route::delete('/houses/{house}', 'HouseController@destroy')->name('houses.destroy');
    Route::match(array('PUT', 'PATCH'), "/houses/{house}", array(
        'uses' => 'HouseController@update',
        'as' => 'houses.update'
    ));
    Route::get('/houses/{house}', 'HouseController@show')->name('houses.show');
    Route::get('/houses/{house}/groups', 'HouseController@allGroups')->name('houses.groups');
    Route::get('/houses/{house}/users', 'HouseController@allUsers')->name('houses.users');


    /**
     * Group Routes
     */

    Route::get('/groups', 'GroupController@index')->name('groups.index');
    Route::post('/groups', 'GroupController@store')->name('groups.store');
    Route::delete('/groups/{group}', 'GroupController@destroy')->name('groups.destroy');
    Route::match(array('PUT', 'PATCH'), "/groups/{group}", array(
        'uses' => 'GroupController@update',
        'as' => 'groups.update'
    ));
    Route::get('/groups/{group}', 'GroupController@show')->name('groups.show');
    Route::get('/groups/{group}/users', 'GroupController@allUsers')->name('groups.users');
    Route::get('/groups/{group}/house', 'GroupController@house')->name('groups.house');

});

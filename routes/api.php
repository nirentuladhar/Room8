<?php

use Illuminate\Http\Request;
use App\User;


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

// Route::middleware(['auth:api'])->get('/user', function (Request $request) {
//     $request->user();
// });

// Route::get('/users', function () {
//     return response()->json(User::all(), 200);
// });

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {

    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');
    Route::post('payload', 'AuthController@payload');
});

Route::group([
    'middleware' => ['api', 'jwt.auth'],
    'prefix' => 'test'
], function ($router) {
    Route::get('/users', function () {
        return response()->json(User::all(), 200);
    });
});
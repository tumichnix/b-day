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

Route::group([
    'namespace' => 'Api',
], function () {

    Route::group([
        'prefix' => 'user'
    ], function () {

        Route::get('/', 'UserController@getIndex')
            ->name('api.user.get.index');
        Route::get('{user}', 'UserController@getShow')
            ->name('api.user.get.show');
    });
});

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

Route::prefix('v1')->namespace('Api')->group(function(){

    Route::name('products.')->group(function(){

        Route::resource('products', 'ProductsController');

    });


    Route::name('users .')->group(function(){

        Route::resource('users', 'UsersController');

    });

    Route::name('categories .')->group(function(){

        Route::resource('categories', 'CategoriesController');

    });

});

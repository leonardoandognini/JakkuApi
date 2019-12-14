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


    Route::post('login', 'Auth\\LoginJWTController@login')->name('login');
    Route::get('logout', 'Auth\\LoginJWTController@logout')->name('logout');
    Route::get('refresh', 'Auth\\LoginJWTController@refresh')->name('refresh');


    Route::group(['middleware' => ['jwt.auth']], function (){
        Route::name('products.')->group(function(){

            Route::resource('products', 'ProductsController');

        });

        Route::name('users .')->group(function(){

            Route::resource('users', 'UsersController');

        });

        Route::name('categories.')->group(function(){

            Route::get('categories/{id}/products', 'CategoriesController@product');

            Route::resource('categories', 'CategoriesController');

        });

        Route::name('images.')->prefix('images')->group(function (){
            Route::delete('/{id}', 'ProductsImagesController@delete')->name('delete');
            Route::put('/set-img/{imageId}/{productId}', 'ProductsImagesController@setImg')->name('delete');
        });

    });

});

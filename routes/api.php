<?php


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


Route::group(['namespace' => 'Api'], function () {
    Route::apiResource('baskets', 'BasketController');
    Route::apiResource('baskets.items', 'ItemController', ['only' => ['store', 'destroy']]);
});

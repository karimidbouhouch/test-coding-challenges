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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('getProducts','ProductController@getProducts');
Route::post('AddProduct','ProductController@AddProduct');
Route::delete('deleteProduct/{id?}','ProductController@deleteProduct');


Route::get('getCategories','CategoryController@getCategories');


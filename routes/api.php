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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

//categories
Route::get('/categories', 'Api\Categories\CategoryController@getAllCategories');
Route::get('/categories/{category_id}', 'Api\Categories\CategoryController@getCategory');
Route::post('/categories', 'Api\Categories\CategoryController@storeCategory');
Route::put('/categories/{category_id}', 'Api\Categories\CategoryController@updateCategory');
Route::delete('/categories/{category_id}', 'Api\Categories\CategoryController@deleteCategory');

//tags
Route::get('/tags', 'Api\Tags\TagController@getAllTags');
Route::get('/tags/{tag_id}', 'Api\Tags\TagController@getTag');
Route::post('/tags', 'Api\Tags\TagController@storeTag');
Route::put('/tags/{tag_id}', 'Api\Tags\TagController@updateTag');
Route::delete('/tags/{tag_id}', 'Api\Tags\TagController@deleteTag');


//image upload
Route::post('/images/{type}','Api\Files\ImageController@store');
Route::post('/images/resize/{type}','Api\Files\ImageController@storeResize');
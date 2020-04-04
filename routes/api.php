<?php

use Illuminate\Http\Request;

/*php
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

Route::apiResources(['user' => 'API\UserController']);
Route::apiResources(['penyewa' => 'API\PenyewaController']);
Route::apiResources(['lokasi' => 'API\LocationController']);
Route::apiResources(['tenan' => 'API\TenantController']);

Route::get('lokasitenan', 'API\TenantController@lokasiTenant');
Route::get('lokasitenan/{id}', 'API\TenantController@lokasiTenantId');

Route::get('collector', 'API\UserController@collector');

Route::get('findUser', 'API\UserController@search');
Route::get('findTenan/{id}', 'API\TenantController@search');
Route::get('findPenyewa', 'API\PenyewaController@search');
Route::get('findLocation', 'API\LocationController@search');
Route::get('findLocationTenant', 'API\LocationController@search2');


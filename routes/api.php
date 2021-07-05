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
Route::apiResources(['tarif' => 'API\TarifController']);
Route::apiResources(['kategori' => 'API\KategoriController']);
Route::apiResources(['setoran' => 'API\SetoranController']);
Route::apiResources(['transaksi' => 'API\TransaksiController']);
Route::apiResources(['tunggakan' => 'API\TunggakanController']);

Route::get('lokasitenan', 'API\TenantController@lokasiTenant');
Route::get('lokasitenan/{id}', 'API\TenantController@lokasiTenantId');

Route::get('owner', 'API\UserController@owner');
Route::get('kolektor', 'API\UserController@kolek');
Route::get('auth', 'API\UserController@profile');
Route::post('photo/{id}', 'API\UserController@update');
Route::post('profile', 'API\UserController@updateProfile');
Route::get('penyewa2', 'API\PenyewaController@index2');
Route::get('pendapatan', 'API\PendapatanController@index');
Route::get('findPendapatan', 'API\PendapatanController@search');
Route::get('landingpage-setting', 'API\LandingpageSettingController@index');
Route::post('landingpage-setting', 'API\LandingpageSettingController@update');

Route::get('contact-us', 'API\ContactUsController@index');
Route::get('lokasi-tenant', 'API\LocationController@lokasiDanTenant');

Route::get('findUser', 'API\UserController@search');
Route::get('findTenan/{id}', 'API\TenantController@search');
Route::get('findPenyewa', 'API\PenyewaController@search');
Route::get('findTarif', 'API\TarifController@search');
Route::get('findKategori', 'API\KategoriController@search');
Route::get('findSetoran', 'API\SetoranController@search');
Route::get('findTransaksi', 'API\TransaksiController@search');
Route::get('findTunggakan', 'API\TunggakanController@search');
Route::get('findLocation', 'API\LocationController@search');
Route::get('findLocationTenant', 'API\LocationController@search2');

Route::get('company', 'API\PerusahaanController@index');
Route::get('collector/{id}', 'API\UserController@kolektor');
Route::post('company/{id}', 'API\PerusahaanController@update');
Route::delete('lokasi2/{id}', 'API\LocationController@destroy2');
Route::delete('user2/{id}', 'API\UserController@destroy2');
Route::delete('penyewa2/{id}', 'API\PenyewaController@destroy2');
Route::delete('tenan2/{id}', 'API\TenantController@destroy2');
Route::get('dashboard', 'API\DashboardController@index');
Route::get('infotr', 'API\TransaksiController@info');
Route::get('year', 'API\TransaksiController@years');
Route::get('transaksi-year', 'API\TransaksiController@indexByYear');

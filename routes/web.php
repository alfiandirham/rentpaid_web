<?php


Route::get('/', function () {
    return redirect()->route('login');
});
Auth::routes(['register' => false]);

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/qrcode', 'HomeController@qrcode');
Route::get('/wilayah/{id}', 'HomeController@pesewa');
Route::get('/qrcode/{id}', 'HomeController@qrcode2');
Route::get('/xl-transaksi', 'HomeController@transaksi');
Route::get('/xl-tunggakan', 'HomeController@tunggakan');
Route::get('/xl-setoran', 'HomeController@setoran');
Route::get('/xl-lokasi-tenant/{id}', 'HomeController@lokasiTenant');

Route::get('{path}',"HomeController@index")->where( 'path', '[A-Za-z\-]+' );
Route::get('/tenant/{path}',"HomeController@index")->where( 'path', '[0-9]+' );

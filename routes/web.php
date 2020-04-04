<?php


Route::get('/', function () {
    return redirect()->route('login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('invoice', function(){
    return view('invoice');
});

Route::get('{path}',"HomeController@index")->where( 'path', '[A-Za-z]+' );
Route::get('/tenant/{path}',"HomeController@index")->where( 'path', '[0-9]+' );

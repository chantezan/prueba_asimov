<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::group(['middleware' => ['cors']],function(){
Route::get('/', function () {
    return view('welcome');
});

  Route::get('/hola', function () {
    return "ble";
  });
  Route::post('/save_book','BookController@store');
  Route::post('/show','BookController@show');
  Route::post('/edit','BookController@edit');
  Route::post('/delete_book','BookController@delete');

}
);

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


Route::get('/', function () {
    return view('welcome');
});
Route::get('home', function () {
    return view('welcome');
});
Route::get('hospitals', 'HospitalController@list');


Route::get('search', 'SearchController@getView')->name('search');

Route::get('search/list', 'SearchController@list');
Route::post('search/list', 'SearchController@list');

Route::get('autocomplete', 'SearchController@autocomplete')->name('autocomplete');

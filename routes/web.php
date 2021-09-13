<?php

use Illuminate\Support\Facades\Route;

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
    return view('auth.login');
});
Auth::routes();

Route::get('/success/{email}/{pwd}', 'HomeController@success')->name('success');



Route::group(['middleware' => ['auth', 'can:isUser']], function () {
    Route::get('/home', 'HomeController@index')->name('home');
});

Route::group(['middleware' => ['auth', 'can:isAdmin']], function () {
    Route::get('/admin', 'HomeController@adminHome')->name('admin');
     Route::put('/activate/{id}', 'HomeController@activate')->name('activate.user');
     Route::put('/deactivate/{id}', 'HomeController@deactivate')->name('deactivate.user');
});

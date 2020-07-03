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

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'product'], function () {
    Route::get('/', 'ProductController@index');
    Route::get('/create', 'ProductController@create');
    Route::post('/', 'ProductController@store');
    Route::get('/{id}', 'ProductController@show');
    Route::get('/{id}/edit', 'ProductController@edit');
    Route::put('/{id}', 'ProductController@update');
    Route::delete('/{id}', 'ProductController@destroy');
});

Route::group(['prefix' => 'customer'], function () {
    Route::get('/', 'CustomerController@index');
    Route::get('/create', 'CustomerController@create');
    Route::get('/{id}', 'CustomerController@show');
    Route::post('/', 'CustomerController@store');
    Route::get('/{id}/edit', 'CustomerController@edit');
    Route::put('/{id}', 'CustomerController@update');
    Route::delete('/{id}', 'CustomerController@destroy');
});

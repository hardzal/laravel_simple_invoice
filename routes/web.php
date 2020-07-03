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

Route::group(['middleware' => 'auth'], function () {
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

    Route::group(['prefix' => 'invoice'], function () {
        Route::get('/', 'InvoiceController@index')->name('invoice.index');
        Route::get('/create', 'InvoiceController@create')->name('invoice.create');
        Route::post('/', 'InvoiceController@store')->name('invoice.store');
        Route::get('/{id}/edit', 'InvoiceController@edit')->name('invoice.edit');
        Route::put('/{id}', 'InvoiceController@update')->name('invoice.update');
        Route::delete('/{id}', 'InvoiceController@deleteProduct')->name('invoice.delete_product');
        Route::delete('/{id}/delete', 'InvoiceController@delete')->name('invoice.destroy');
        Route::get('/{id}/print', 'InvoiceController@generateInvoice')->name('invoice.print');
    });
});

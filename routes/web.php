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

Route::get('/', 'App\Http\Controllers\HomeController@index');
Route::get('/product/{id}/{ref}', 'App\Http\Controllers\ProductController@index')->name('product');
Route::get('/prod-amount', 'App\Http\Controllers\ProductController@getProdAmount');
Route::get('/login', function(){
    return view('login');
});

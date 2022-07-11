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

// Login
Route::get('/login', 'App\Http\Controllers\LoginController@index');

// Home
Route::get('/', 'App\Http\Controllers\HomeController@index');

// Products
Route::get('/product/{id}/{ref}', 'App\Http\Controllers\ProductController@index')->name('product');
Route::get('/products', 'App\Http\Controllers\ProductsController@index');

// Cart
Route::get('/cart', 'App\Http\Controllers\CartController@index');

// Transaction redirect
Route::get('/transaction', 'App\Http\Controllers\CartController@empty');

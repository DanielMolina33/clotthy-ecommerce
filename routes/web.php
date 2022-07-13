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
Route::get('/register', 'App\Http\Controllers\LoginController@register');

// Password
Route::get('password-forgot', 'App\Http\Controllers\LoginController@passwordForget');
Route::get('/password/reset/{userType}/{id}/{token}/{tokenId}', 'App\Http\Controllers\PasswordController@index');
Route::post('/reset/{userType}/{id}/{token}/{tokenId}', 'App\Http\Controllers\PasswordController@reset')->name('reset');

// Home
Route::get('/', 'App\Http\Controllers\HomeController@index');

// Products
Route::get('/product/{id}/{ref}', 'App\Http\Controllers\ProductController@index')->name('product');
Route::get('/products', 'App\Http\Controllers\ProductsController@index');

// Cart
Route::get('/cart', 'App\Http\Controllers\CartController@index');

// Transaction redirect
Route::get('/transaction', 'App\Http\Controllers\CartController@empty');

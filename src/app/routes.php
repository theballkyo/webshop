<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/
Route::when('*', 'csrf', array('post'));

Route::get('/', 'HomeController@Index');
Route::get('/shop', 'HomeController@getShop');

Route::get('/user/login', 'UserController@getLogin');
Route::post('/user/login', 'UserController@postLogin');
Route::get('/user/register', 'UserController@getRegister');
Route::post('/user/register', 'UserController@postRegister');
Route::get('/user/logout', 'UserController@getLogout');

Route::get('/admin/', 'AdminController@Index');
Route::get('/admin/stocks', 'AdminController@getStocks');
Route::get('/admin/stock/{pid}/{color}', 'AdminController@getStock');
Route::post('/admin/stock/{pid}/{color}', 'AdminController@postStock');
Route::get('/admin/products', 'AdminController@getProducts');
Route::get('/admin/product/{pid}/add/color', 'AdminController@getAddColor');
Route::post('/admin/product/{pid}/add/color', 'AdminController@postAddColor');
Route::get('/admin/product/{pid}/add/size', 'AdminController@getAddSize');
Route::post('/admin/product/{pid}/add/size', 'AdminController@postAddSize');
Route::get('/admin/product/new', 'AdminController@getProductNew');

Route::post('admin/product/save', 'AdminController@postProductSave');

Route::get('/product/{pid}', 'ProductController@getProduct');

Route::get('/test', 'TestController@Index');
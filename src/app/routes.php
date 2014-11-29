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

/**
 * Route for User system
 *
 */
Route::get('/user/login', 'UserController@getLogin');
Route::post('/user/login', 'UserController@postLogin');
Route::get('/user/register', 'UserController@getRegister');
Route::post('/user/register', 'UserController@postRegister');
Route::get('/user/logout', 'UserController@getLogout');

/**
 * Route for Admin Panel
 *
 */
Route::get('/admin/', 'AdminController@Index');

Route::get('/admin/order/new', 'OrderController@newOrder');
Route::post('/admin/order/new', 'OrderController@postNewOrder');

Route::get('admin/order/print', 'OrderController@printOrder');
Route::get('admin/order/print/view', 'OrderController@viewPrintOrder');
Route::get('admin/order/print/re', 'OrderController@rePrintOrder');

Route::get('admin/order/view', 'OrderController@viewOrder');
Route::get('admin/order/view/{id}', 'OrderController@showOrder');
Route::post('admin/order/view/{id}', 'OrderController@postUpdateOrder');
Route::get('admin/order/add/{id}', 'OrderController@add');
Route::post('admin/order/add/{id}', 'OrderController@postAdd');
Route::get('admin/order/pay/{id}', 'OrderController@payOrder');
Route::get('admin/order/cancel/{id}', 'OrderController@cancelOrder');
Route::any('admin/order/cancelr/{id}/{rid}', 'OrderController@cancelReserve');

Route::get('/admin/stocks', 'AdminController@getStocks');
Route::get('/admin/stock/get/{pid}/{color}', 'AdminController@getStock');
Route::post('/admin/stock/get/{pid}/{color}', 'AdminController@postStock');
Route::get('/admin/stock/show/{pid}', 'AdminController@getShowStock');
Route::post('/admin/stock/show/{pid}', 'AdminController@postShowStock');


Route::get('/admin/products', 'AdminController@getProducts');
Route::get('/admin/product/add/color/{pid}', 'AdminController@getAddColor');
Route::post('/admin/product/add/color/{pid}', 'AdminController@postAddColor');

Route::get('/admin/product/add/size/{pid}', 'AdminController@getAddSize');
Route::post('/admin/product/add/size/{pid}', 'AdminController@postAddSize');

Route::get('/admin/stock/delete/color/{color}', 'AdminController@getDeleteColor');
Route::post('/admin/stock/delete/color/{color}', 'AdminController@postDeleteColor');

Route::get('/admin/stock/delete/size/{size}', 'AdminController@getDeleteSize');
Route::post('/admin/stock/delete/size/{size}', 'AdminController@postDeleteSize');

Route::get('admin/reserve', 'AdminController@getReserve');
Route::post('admin/reserve/payment', 'AdminController@postReservePay');
Route::get('admin/reserve/discount/{id}', 'AdminController@getReserveDis');
Route::post('admin/reserve/discount/{id}', 'AdminController@postReserveDis');
Route::any('admin/reserve/cancel/{code}', 'AdminController@cancelReserve');

Route::get('/admin/stock/reserve/{code}', 'AdminController@getStockReserve');
Route::post('/admin/stock/reserve/{code}', 'AdminController@postStockReserve');

Route::get('/admin/customer', 'AdminController@getAllCustomer');
Route::get('/admin/customer/add', 'AdminController@getAddCustomer');
Route::post('/admin/customer/add', 'AdminController@postAddCustomer');
Route::post('/admin/customer/del', 'AdminController@postDelCustomer');
Route::get('/admin/customer/{id}', 'AdminController@getCustomer');
Route::post('/admin/customer/{id}', 'AdminController@postCustomer');

Route::get('/admin/product/new', 'AdminController@getProductNew');
Route::post('admin/product/save', 'AdminController@postProductSave');

/**
 * Route for Products
 *
 */
Route::get('/product/{pid}', 'ProductController@getProduct');
Route::get('/test', 'TestController@Index');
Route::get('/test2', 'OrderController@test');
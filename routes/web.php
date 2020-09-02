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
    return view('welcome');
});

Route::get('getproductlist', 'GetProductListController@getproductlist');
Route::get('pos', 'POSController@index');
Route::get('getcustomerlist', 'CustomerController@getCustomer');
Route::get('order/printinvoice', 'OrderController@printinvoice');
Route::post('order', 'OrderController@saveorder');
Route::get('customer', 'CustomerController@index');




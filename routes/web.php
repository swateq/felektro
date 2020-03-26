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

Auth::routes();

Route::group(['middleware' => ['auth']], function () {
    Route::get('/', 'MainOrderController@index');

    Route::get('/main_order/{id}', 'MainOrderController@show');
    Route::get('/order/{id}', 'OrderController@show');
    Route::get('/order_position/{id}', 'OrderPositionController@create');
    Route::post('/order_position','OrderPositionController@store');
    Route::get('/order_position/doing/{id}','OrderPositionController@show');
    Route::post('/order_position/done/{id}','OrderPositionController@update');

    Route::get('/product/{id}', 'ProductController@show');
    Route::get('/komplet/{id}', 'ProductController@showKomplet');
});


Route::get('/cron/orders','CronController@getZK');

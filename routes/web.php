<?php

use Illuminate\Support\Facades\Route;

Auth::routes();

Route::group(['middleware' => ['auth']], function () {
    Route::get('/', 'MainOrderController@index');

    /**
     * /main_order
     */
    Route::get('/main_order/{id}', 'MainOrderController@show');
    Route::get('/main_order/{id}/accept', 'MainOrderController@accept');
    Route::get('/main_order/{id}/redeem', 'MainOrderController@redeem');

    /**
     * /order
     */
    Route::get('/order/{id}', 'OrderController@show');

    /**
     * /order_position
     */
    Route::get('/order_position/{id}', 'OrderPositionController@create');
    Route::post('/order_position','OrderPositionController@store');
    Route::get('/order_position/doing/{id}','OrderPositionController@show');
    Route::post('/order_position/done/{id}','OrderPositionController@update');

    /**
     * /product
     */
    Route::get('/product/search', 'ProductController@index');
    Route::get('/product/{id}', 'ProductController@show');
    Route::get('/product', 'ProductController@search');

    /**
     * /komplet
     */
    Route::get('/komplet/{id}', 'ProductController@showKomplet');

    /**
     * /export
     */
    Route::get('/redeem/export/{id}', 'MainOrderController@redeemExport');

});
Route::group(['middleware' => ['can:isAdmin']], function () {
    /**
     * /admin/workers
     */
    Route::get('/admin/workers', 'WorkerController@index');
    Route::get('/admin/workers/create', 'WorkerController@create');
    Route::post('/admin/workers', 'WorkerController@store');
    Route::get('/admin/workers/delete/{id}', 'WorkerController@destroy');
});


/**
 * /cron
 */
Route::get('/cron/orders','CronController@getZK');

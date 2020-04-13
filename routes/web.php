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

Route::get('/', function () {
    return \Redirect::to('admin/login');
});

Route::prefix('admin')->group(function ()
{
    Auth::routes();

    Route::middleware(['after' => 'auth'])->group(function () {

        Route::get('/dashboard',  'System\HomeController@index')->name('dashboard');

        Route::resource('/produtos', 'System\ProductController');
        Route::put('/produtos/baixa/{id}', 'System\ProductController@decrement')->name('product_decrement');
        Route::delete('/produtos/imagem/{id}/delete', "System\ProductController@deleteImage")->name('product_image_delete');

        Route::get('/relatorio-diario',  'System\ReportController@byDay')->name('daily_report');
        Route::get('/relatorio-estoque',  'System\ReportController@stock')->name('stock_report');

        Route::get('/image/external', 'System\ImagesController@image')->name('image');

    });
});

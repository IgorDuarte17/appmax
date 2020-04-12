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

Route::prefix('admin')->group(function ()
{
    Route::get('/dashboard',  'HomeController@index')->name('dashboard');

    Route::resource('/produtos', 'ProductController');
    Route::put('/produtos/baixa/{id}', 'ProductController@decrement')->name('product_decrement');
    Route::delete('/produtos/imagem/{id}/delete', "ProductController@deleteImage")->name('product_image_delete');

    Route::get('/image/external', 'ImagesController@image')->name('image');
});

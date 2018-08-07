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
use App\TheLoai;

Route::get('/', function () {
    return view('admin.login');
});

Route::group(['prefix' => 'admin'], function() {
    Route::group(['prefix' => 'theloai'], function() {
        // admin/theloai/list...
        Route::get('list', 'TheLoaiController@getList');

        Route::get('addNew', 'TheLoaiController@getAddNew');
        Route::post('addNew', 'TheLoaiController@postAddNew');

        Route::get('edit', 'TheLoaiController@edit');
    });

    Route::group(['prefix' => 'loaitin'], function() {
        // admin/loaitin/list...
        Route::get('list', 'LoaiTinController@getList');

        Route::get('addNew', 'LoaiTinController@addNew');

        Route::get('edit', 'LoaiTinController@edit');
    });

    Route::group(['prefix' => 'tintuc'], function() {
        // admin/tintuc/list...
        Route::get('list', 'TinTucController@getList');

        Route::get('addNew', 'TinTucController@addNew');

        Route::get('edit', 'TinTucController@edit');
    });

});





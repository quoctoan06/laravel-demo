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
    return view('welcome');
});

/* Admin */
Route::get('admin/login', 'UserController@getLoginAdmin');
Route::post('admin/login', 'UserController@postLoginAdmin');
Route::get('admin/logout', 'UserController@logoutAdmin'); 

Route::group(['prefix' => 'admin', 'middleware' => 'adminLogin'], function() {
    Route::group(['prefix' => 'theloai'], function() {
        // admin/theloai/list...
        Route::get('list', 'TheLoaiController@getList');

        Route::get('addNew', 'TheLoaiController@getAddNew');
        Route::post('addNew', 'TheLoaiController@postAddNew');

        Route::get('edit/{id}', 'TheLoaiController@getEdit');
        Route::post('edit/{id}', 'TheLoaiController@postEdit');

        Route::get('delete/{id}', 'TheLoaiController@delete');
    });

    Route::group(['prefix' => 'loaitin'], function() {
        // admin/loaitin/list...
        Route::get('list', 'LoaiTinController@getList');

        Route::get('addNew', 'LoaiTinController@getAddNew');
        Route::post('addNew', 'LoaiTinController@postAddNew');

        Route::get('edit/{id}', 'LoaiTinController@getEdit');
        Route::post('edit/{id}', 'LoaiTinController@postEdit');

        Route::get('delete/{id}', 'LoaiTinController@delete');
    });

    Route::group(['prefix' => 'tintuc'], function() {
        // admin/tintuc/list...
        Route::get('list', 'TinTucController@getList');

        Route::get('addNew', 'TinTucController@getAddNew');
        Route::post('addNew', 'TinTucController@postAddNew');

        Route::get('edit/{id}', 'TinTucController@getEdit');
        Route::post('edit/{id}', 'TinTucController@postEdit');

        Route::get('delete/{id}', 'TinTucController@delete');
    });

    Route::group(['prefix' => 'comment'], function() {

        Route::get('delete/{idComment}/{idTinTuc}', 'CommentController@delete');

    });

    Route::group(['prefix' => 'slide'], function() {

        Route::get('list', 'SlideController@getList');

        Route::get('addNew', 'SlideController@getAddNew');
        Route::post('addNew', 'SlideController@postAddNew');

        Route::get('edit/{id}', 'SlideController@getEdit');
        Route::post('edit/{id}', 'SlideController@postEdit');

        Route::get('delete/{id}', 'SlideController@delete');

    });

    Route::group(['prefix' => 'user'], function() {

        Route::get('list', 'UserController@getList');

        Route::get('addNew', 'UserController@getAddNew');
        Route::post('addNew', 'UserController@postAddNew');

        Route::get('edit/{id}', 'UserController@getEdit');
        Route::post('edit/{id}', 'UserController@postEdit');

        Route::get('delete/{id}', 'UserController@delete');

    });

    Route::group(['prefix' => 'ajax'], function() {

        Route::get('loaitin/{idTheLoai}', 'AjaxController@getLoaiTin');

    });

});

/* Web pages */

Route::get('home', 'PageController@getHomePage');
Route::get('contact', 'PageController@getContactPage');



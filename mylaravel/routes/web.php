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
/*home route*/
Route::get('/', 'Home\IndexController@index');
Route::get('/list/{cate_id}', 'Home\IndexController@list');
Route::get('/a/{art_id}', 'Home\IndexController@art');
Route::get('/error','Home\IndexController@error');

/*admin route*/
Route::any('admin/login', 'Admin\LoginController@login');
Route::get('admin/code', 'Admin\LoginController@code');



Route::group(['middleware'=>['admin.login'], 'prefix'=>'admin', 'namespace'=>'Admin'], function () {

    Route::get('/index', 'IndexController@index');
    Route::get('quit', 'LoginController@quit');
    Route::any('changepass', 'IndexController@changepass');


    Route::get('article', 'IndexController@article');


    Route::post('category/changeorder', 'CategoryController@changeorder');
    Route::resource('category', 'CategoryController');
    Route::resource('article', 'ArticleController');




    Route::post('navbar/changeorder', 'NavbarController@changeorder');
    Route::resource('navbar', 'NavbarController');




    Route::post('links/changeorder', 'LinksController@changeorder');
    Route::resource('links', 'LinksController');

    Route::get('config/create_conf', 'ConfigController@create_conf');
    Route::post('config/changeorder', 'ConfigController@changeorder');
    Route::post('config/changecontent', 'ConfigController@changecontent');
    Route::resource('config', 'ConfigController');


    Route::any('upload', 'CommonController@upload');
});
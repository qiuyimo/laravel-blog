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
    return view('welcome');
});

Route::get('demo', 'DemoController@index');

Route::get('article/{urlName}/{createTime}', 'ArticleController@article')->where(['urlName' => '[a-z0-9-]+', 'createTime' => '[0-9]{10}']);

Route::get('article/{page?}', 'ArticleController@list')->where('page', '[0-9]+')->name('article-list');

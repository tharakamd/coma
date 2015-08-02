<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/compiler','CompileController@index');
Route::get('/go','CompileController@compile');
Route::get('/test','CompileController@compile_test');
Route::get('/upload','CompileController@upload_file');
Route::get('/compile','CompileController@compile_file');
Route::get('/contact','PagesController@contact');
Route::get('/','PagesController@home');
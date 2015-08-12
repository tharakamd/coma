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
Route::get('/courses','PagesController@courses');
Route::get('/assignment/{course}','PagesController@assignment');
Route::get('/code/{course}/{assignment}','PagesController@code');
Route::post('/upload/{user}/{course}/{assignment}','PagesController@upload_file');
Route::get('/compile/{user}/{course}/{assignment}','PagesController@compile');
Route::get('/add/assignment/new/{user}/{course}','AssignmentController@add_assignment');
Route::post('/add/assignment/create/{user}/{course}','AssignmentController@create_assignment');
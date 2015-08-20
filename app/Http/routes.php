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





// Code routers
Route::get('/code/{course}/{assignment}','CodeController@listCodes');
Route::post('/upload/{course}/{assignment}','CodeController@uploadFile');
Route::get('/compile/{course}/{assignment}','CodeController@compileAll');


// Assignment routers
Route::get('/assignment/{course}','AssignmentController@listAssignments');
Route::get('/add/assignment/new/{course}','AssignmentController@addAssignment');
Route::post('/add/assignment/create/{course}','AssignmentController@createAssignment');


// Course routers
Route::get('/course',['middleware'=>'auth','uses'=>'CourseController@listCourses']);
Route::get('/add/course/',['middleware'=>'auth','uses'=>'CourseController@addCourse']);
Route::post('/add/course/create',['middleware'=>'auth','uses'=>'CourseController@createCourse']);


// Authentication routes...
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');


// Registration routes...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');


// home page
Route::get('/home',['middleware'=>'auth','uses'=>'PagesController@home']);
Route::get('/',['middleware'=>'auth','uses'=>'PagesController@home']);

// temp routes

Route::get('/testlog','PagesController@showLoging');
Route::get('/testReg','PagesController@showSignup');
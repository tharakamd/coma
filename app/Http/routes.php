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
Route::get('/code/{course}/{assignment}',['middleware'=>'auth','uses'=>'CodeController@listCodes']);
Route::post('/upload/{course}/{assignment}',['middleware'=>'auth','uses'=>'CodeController@uploadFile']);
Route::post('/uploadZip/{course}/{assignment}',['middleware'=>'auth','uses'=>'CodeController@uploadZipFile']);
Route::get('/compile/{course}/{assignment}',['middleware'=>'auth','uses'=>'CodeController@compileAll']);
Route::get('/remove/code/{course}/{assignment}/{code}',['middleware'=>'auth','uses'=>'CodeController@removeCode']);

// Assignment routers
Route::get('/assignment/{course}',['middleware'=>'auth','uses'=>'AssignmentController@listAssignments']);
Route::get('/add/assignment/new/{course}',['middleware'=>'auth','uses'=>'AssignmentController@addAssignment']);
Route::post('/add/assignment/create/{course}',['middleware'=>'auth','uses'=>'AssignmentController@createAssignment']);
Route::get('/remove/assignment/{course}/{assignment}',['middleware'=>'auth','uses'=>'AssignmentController@removeAssignment']);

// Course routers
Route::get('/course',['middleware'=>'auth','uses'=>'CourseController@listCourses']);
Route::get('/add/course/',['middleware'=>'auth','uses'=>'CourseController@addCourse']);
Route::post('/add/course/create',['middleware'=>'auth','uses'=>'CourseController@createCourse']);
Route::get('/remove/course/{course}',['middleware'=>'auth','uses'=>'CourseController@removeCourse']);


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
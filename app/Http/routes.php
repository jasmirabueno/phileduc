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

Route::get('/', function(){

	return view('home');
});

Route::get('/thankyou', function(){

	return view('thankyou');
});

Route::get('student/thankyou', function(){

	return view('student.thankyou');
});

Route::resource('main-admin', 'MainAdminController');
Route::resource('institution', 'InstitutionController');
Route::resource('professor', 'ProfessorController');
Route::resource('course', 'CourseController');
Route::resource('student', 'StudentController');
Route::resource('lecture', 'LectureController');

Route::post('user/change/{user_param}', 'UserController@change');
Route::post('main_admin/accept', 'MainAdminController@accept_inst');
Route::post('main_admin/decline', 'MainAdminController@decline_inst');
Route::post('main_admin/accept_categ', 'MainAdminController@accept_categ');
Route::post('main_admin/decline_categ', 'MainAdminController@decline_categ');

Route::post('institution/accept', 'InstitutionController@accept_prof');
Route::post('institution/decline', 'InstitutionController@decline_prof');
Route::post('institution/edit_profile', 'InstitutionController@edit_profile');
Route::post('institution/categ_requests', 'InstitutionController@categ_requests');
Route::post('institution/add-course', 'InstitutionController@add_course');

Route::post('professor/edit_profile', 'ProfessorController@edit_profile');
Route::get('professor/add-lecture/{id}', 'ProfessorController@add_lecture');
Route::post('professor/add-lecture', 'ProfessorController@post_add_lecture');

Route::post('course/open', 'CourseController@open_course');

Route::post('student/enroll', 'StudentController@enroll');

Route::get('registration-success', function(){

	return view('student.thankyou');
});


// Authentication routes...
Route::get('login/{id}', 'Auth\AuthController@getLogin');
Route::post('login/{id}', 'Auth\AuthController@postLogin');
Route::get('logout', 'Auth\AuthController@getLogout');

// Registration routes...

Route::post('register/institution', 'Auth\AuthController@postInstRegister');
Route::post('register/professor', 'Auth\AuthController@postProfRegister');
Route::post('register', 'Auth\AuthController@postUserRegister');
Route::get('register/student-profile', 'Auth\AuthController@getStudRegister');
Route::post('register/student_profile', 'Auth\AuthController@postStudRegister');
Route::get('register/{id}', 'Auth\AuthController@getRegister');
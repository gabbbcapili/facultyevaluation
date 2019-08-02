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

// test routes




Route::get('/', function () {
    return redirect('login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home')->middleware('auth');
//users
Route::get('user/changePassword', 'UserController@changePasswordForm')->middleware('auth');
Route::put('user/changePassword', 'UserController@changePasswordUpdate')->middleware('auth');
Route::get('createStudents', 'UserController@createStudents')->middleware('admin');

Route::get('student/import', 'StudentController@import')->middleware('admin');
Route::get('student/getCSV', 'StudentController@getCSV')->middleware('admin');
Route::post('student/import', 'StudentController@postImport')->middleware('admin');

Route::delete('user/{user}', 'UserController@destroy')->middleware('admin');
Route::get('user/delete/{user}', 'UserController@delete')->middleware('admin');


Route::get('test', 'DepartmentController@test')->middleware('admin');

Route::get('csv', 'ContactController@getCSV')->middleware('admin');
Route::post('csv', 'ContactController@postCSV')->middleware('admin');

Route::get('contacts/delete/{contact}', 'ContactController@delete')->middleware('admin');

//department
Route::get('department/delete/{department}', 'DepartmentController@delete')->middleware('admin');

//course
Route::get('course/delete/{course}', 'CourseController@delete')->middleware('admin');

//section
Route::get('section/delete/{section}', 'SectionController@delete')->middleware('admin');

// resource contorller
Route::resource('student', 'StudentController', ['parameters' => [
    'student' => 'user'
]])->middleware('admin')->except(['destroy']);
Route::resource('faculty', 'FacultyController', ['parameters' => [
    'faculty' => 'user'
]])->middleware('admin')->except(['destroy']);
Route::resource('contacts', 'ContactController')->middleware('admin');
Route::resource('sms', 'SmsController')->middleware('admin');
Route::resource('department', 'DepartmentController')->middleware('admin');
Route::resource('course', 'CourseController')->middleware('admin');
Route::resource('section', 'SectionController')->middleware('admin');

Route::put('test', function(){
	return 'asdasdsa';
});

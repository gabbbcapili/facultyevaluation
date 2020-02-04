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
    return redirect('login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home')->middleware('auth');
//users
Route::get('user/changePassword', 'UserController@changePasswordForm')->middleware('auth');
Route::put('user/changePassword', 'UserController@changePasswordUpdate')->middleware('auth');
Route::get('createStudents', 'UserController@createStudents')->middleware('admin');

Route::get('student/import', 'StudentController@import')->middleware('employee');
Route::get('student/getCSV', 'StudentController@getCSV')->middleware('employee');
Route::post('student/import', 'StudentController@postImport')->middleware('employee');

Route::delete('user/{user}', 'UserController@destroy')->middleware('admin');
Route::get('user/delete/{user}', 'UserController@delete')->middleware('admin');

Route::get('report/evaluation', 'ReportController@index')->middleware('admin')->name('report.index');
Route::get('report/getEmployees/{department}', 'ReportController@getEmployees')->middleware('admin');

//evaluation
Route::get('evaluation/delete/{evaluation}', 'EvaluationController@delete');

//department
Route::get('department/delete/{department}', 'DepartmentController@delete')->middleware('admin');
Route::get('department/getCourses/{department}', 'DepartmentController@getCourses')->middleware('employee');

//course
Route::get('course/delete/{course}', 'CourseController@delete')->middleware('admin');
Route::get('course/getSections/{course}', 'CourseController@getSections')->middleware('employee');
//section
Route::get('section/delete/{section}', 'SectionController@delete')->middleware('admin');

//subject
Route::get('subject/delete/{subject}', 'SubjectController@delete')->middleware('admin');

//dictionary
Route::get('dictionary/updateType/', 'DictionaryController@updateType')->middleware('admin');

// resource contorller
Route::resource('student', 'StudentController', ['parameters' => [
    'student' => 'user'
]])->middleware('employee')->except(['destroy']);
Route::resource('faculty', 'FacultyController', ['parameters' => [
    'faculty' => 'user'
]])->middleware('employee')->except(['destroy']);
Route::resource('department', 'DepartmentController')->middleware('admin');
Route::resource('subject', 'SubjectController')->middleware('admin');
Route::resource('dictionary', 'DictionaryController')->middleware('admin');
Route::resource('course', 'CourseController')->middleware('admin');
Route::resource('section', 'SectionController')->middleware('admin');

Route::get('evaluation/getEvaluationList/{evaluation}', 'EvaluationController@getEvaluationList')->name('getEvaluationList');

Route::resource('evaluation', 'EvaluationController');
Route::resource('list-evaluation', 'EvaluationListController');

Route::put('test', function(){
	return 'asdasdsa';
});

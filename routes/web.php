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

Route::get('/home', 'HomeController@index')->name('home');
Route::resource('users', 'UserController')->middleware('admin');
Route::resource('contacts', 'ContactController')->middleware('admin');
Route::resource('sms', 'SmsController')->middleware('admin');

Route::get('csv', 'ContactController@getCSV')->middleware('admin');
Route::post('csv', 'ContactController@postCSV')->middleware('admin');

Route::get('contacts/delete/{contact}', 'ContactController@delete')->middleware('admin');

Route::get('user/changePassword', 'UserController@changePasswordForm')->middleware('auth');
Route::put('user/changePassword', 'UserController@changePasswordUpdate')->middleware('auth');

Route::put('test', function(){
	return 'asdasdsa';
});

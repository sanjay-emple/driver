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

Route::get('/', 'HomeController@index')->name('home');

Route::get('/logout', function () {
    auth()->logout();
    return redirect()->route('home');
});

Route::get('/dashboard', 'HomeController@index')->name('dashboard');

Route::get('/test', function () {
	echo $ramdom_string = random_string(8);
});

Route::get('/flash', function () {
    return redirect('/invite')
            ->withError('Your request is send to admin for activate account.');
});

Route::get('/admin', function () {
    return view('layouts.admin.app');
});

Auth::routes();


Route::get('/user/changepassword', 'DriverController@change_password_form')->name('user.changepassword.form');
Route::post('/user/changepassword', 'DriverController@change_password')->name('user.changepassword');

Route::get('changeprofile', 'DriverController@change_profile')->name('user.edit');
Route::post('changeprofile', 'DriverController@store_profile')->name('user.store');

Route::get('user/invite', 'DriverController@invite_form')->name('invite.inviteform');
Route::post('user/invite', 'DriverController@invite')->name('invite.invitestore');


Route::get('/home', 'HomeController@index')->name('home');

	Route::group(['middleware'=>'admin'],function(){

	Route::get('/users', 'UserController@index')->name('admin.user.index');
	Route::get('/user/{id}/activate', 'UserController@activate_user')->name('admin.user.activate');
	Route::get('/ajax/getuser', 'UserController@ajax_get_users')->name('ajax.get.users');

	Route::get('/invite', 'InviteController@index')->name('admin.invite.index');
	Route::post('/invite', 'InviteController@store')->name('admin.invite.store');

	Route::get('/user/{id}/edit', 'UserController@change_profile')->name('admin.user.edit');
	Route::post('/user', 'UserController@store_profile')->name('admin.user.store');

	Route::get('/changepassword', 'UserController@change_password_form')->name('admin.user.changepassword.form');
	Route::post('/changepassword', 'UserController@change_password')->name('admin.user.changepassword');

	//Route::post('/userimageupload', 'UserController@user_image_store')->name('admin.user.useriamgestore');

	

});





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

Route::get('/time',function(){

	$user = App\User::find(2);
	dump($user->created_at->addMinutes(120));
});


Route::get('/dashboard', 'HomeController@index')->name('dashboard');


Route::get('/test1', function () {
  $select = \App\Tree::select('id','user_id','parent_id','level')->get()->toArray();

  $new_arr = buildTree($select,1);

  $chunk = array_chunk($new_arr,2);

  dd($chunk);

  foreach ($chunk as $key => $c) {
    $new_arr = buildTree($select,auth()->user()->id);
    dump($new_arr);
  }

  //dump($chunk);

  //return $select;
});

Route::get('/random_num', function () {

	$users = \App\User::get();
	
	foreach ($users as $key => $user) {
		$driver_num = random_num(8);
		$user->update(['driver_num'=>$driver_num]);
	}

});


Route::get('/test', function () {

	$drivers = \App\Tree::get()->toArray();
    $trees = test($drivers,6);

    dump($trees);

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

Route::get('/thankyou','Auth\RegisterController@thankyou')->name('thankyou');

Route::group(['middleware'=>'auth'],function(){
	Route::get('/profileimage', 'UserController@profile_image_form')->name('profile.image.form');
	Route::post('/profileimage', 'UserController@profile_image_store')->name('profile.image.store');
});


Route::get('/home', 'HomeController@index')->name('home');

	Route::group(['middleware'=>'admin'],function(){

	Route::get('/users', 'UserController@index')->name('admin.user.index');
	Route::get('/user/{id}/activate', 'UserController@activate_user')->name('admin.user.activate');
	//Route::post('/delete-driver', 'UserController@deleteDriver')->name('admin.user.deleteDriver');
	Route::post('delete-driver',array(
			'as'=>'deleteDriver',
			'uses'=>'UserController@deleteDriver'
	));
	Route::get('/ajax/getuser', 'UserController@ajax_get_users')->name('ajax.get.users');

	Route::get('/invite', 'InviteController@index')->name('admin.invite.index');
	Route::post('/invite', 'InviteController@store')->name('admin.invite.store');

	Route::get('/user/{id}/edit', 'UserController@change_profile')->name('admin.user.edit');
	Route::post('/user', 'UserController@store_profile')->name('admin.user.store');

	Route::get('/changepassword', 'UserController@change_password_form')->name('admin.user.changepassword.form');
	Route::post('/changepassword', 'UserController@change_password')->name('admin.user.changepassword');

	Route::get('/lavelSettings', 'UserController@setDriverlevel_form')->name('admin.user.lavelSettings.form');
	Route::post('/lavelSettings', 'UserController@updateDriverlevel')->name('admin.user.lavelSettings');

	Route::get('/changeplace', 'UserController@change_position_form')->name('admin.change.position.form');
	Route::post('/changeplace', 'UserController@change_position_store')->name('admin.change.position.store');



	//Route::post('/userimageupload', 'UserController@user_image_store')->name('admin.user.useriamgestore');

	

});





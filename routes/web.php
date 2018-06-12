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


Route::get('/test', function () {

	/*//\App\Tree::truncate();

	$tree_m = App\Tree::where('parent_id',2)->orderBy('id','desc')->first();

	if($tree_m == null)
	{
		$pos = 1;
	}
	else
	{
		$level = $tree_m['level'];

		$pos = $level == 1 ? 2 : 1;
	}

	App\Tree::create([
		'user_id' => 8,
		'parent_id' => 2,
		'level' => $pos
	]);
*/


	$select = \App\Tree::select('id','user_id','parent_id','level')->get()->toArray();

	dump($select);

	$new_arr = buildTree($select,auth()->user()->id);

	/*$new_arr = array_map(function($arr){
		$arrar = [];

		$arrar['user_id'] = $arr['user_id'];
		return $arrar;

	}, $new_arr);*/

	echo json_encode($new_arr);



	//echo $ramdom_string = random_string(8);
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





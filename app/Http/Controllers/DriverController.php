<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Hash;
use App\UserInvite;
use App\Mail\InviteUser;
use Mail;
use File;
use Image;

class DriverController extends Controller
{

	public function __construct()
    {
        $this->middleware('auth');
    }

	public function change_profile()
    {
        $user_m = auth()->user();
        $data = [];
        $data['user'] = $user_m;

        return view('user.edit',$data);
    }

    public function store_profile(Request $res)
    {

    	$user_id = auth()->user()->id;
      $auth_user = auth()->user();

        $rules = [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'address' => 'required',
            'postcode' => 'required|min:3|max:20',
            'telephone' => 'required|min:3|max:20',
            'email' => 'required|string|email|max:255|unique:users,email,'.$user_id,
            'driver_status' => 'required',
        ];

        $this->validate($res,$rules);

        if($res->has('photo'))
        {
           $rules = array_merge($rules,[
              'photo' => 'required|mimes:jpeg,jpg,png' 
           ]);
        }

        $auth_user->update([
            'first_name' => $res->first_name,
            'last_name' => $res->last_name,
            'city' => $res->city,
            'address' => $res->address,
            'email' => $res->email,
            'postcode' => $res->postcode,
            'telephone' => $res->telephone,
            'driver_status' => $res->driver_status  
        ]);

        if($res->has('photo'))
        {

            if($auth_user->profile_img)
            {
              $profile_image_path = $path = public_path('uploads/profile_image/' .$auth_user->profile_img);

               File::delete($profile_image_path);
            }
  
            $image = $res->file('photo');
            $filename  = time() . '.' . $image->getClientOriginalExtension();
            $path = public_path('uploads/profile_image/' . $filename);
            Image::make($image->getRealPath())->resize(128, 128)->save($path);

            $auth_user->update([
              'profile_img' => $filename
            ]);

        }

       session()->flash('success','Profile details updated successfully');
       return redirect()->back();
    }

    public function change_password_form(Request $res)
    {
        return view('user.change_password');
    }

    public function change_password(Request $res)
    {

      // dd($res->all());

       $this->validate($res,[
          'current_password' => 'required',
          'password' => 'required|min:6|confirmed|max:255'
       ]);

       $current_password = auth()->user()->password;

       if (!Hash::check($res->current_password,$current_password)) {
		 session()->flash('error',"Current password don't match");
		 return redirect()->back();
	   }

	   auth()->user()->update(['password'=>bcrypt($res->password)]);

       session()->flash('success','Password change successfully.');
       return redirect()->back();
    }

    public function invite_form()
    {
     	return view('invite.index');
    }

    public function invite(Request $res)
    {

    	$data = array();
        $obj_user = auth()->user();

    		$this->validate($res,[
    		'name' => 'required',
    		'email' => 'required|email',
    		]);

		  $user_data['name'] = $res->name;
          $user_data['email'] = $res->email;
		  $user_data['invite_from'] = $obj_user->fullname();
		  $user_data['url'] = route('register').'?ref='.safe_b64encode($obj_user->url);

		  UserInvite::create([
			  	'name' => $res->name,
			  	'email' => $res->email,
		  ]);

    	 Mail::to($res->email)->send(new InviteUser($user_data));
    	 session()->flash('success','Successfully sent invitation.');
    	 return redirect()->route('invite.inviteform');
    }

}

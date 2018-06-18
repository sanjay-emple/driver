<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\UserInvite;
use App\Mail\InviteUser;
use Mail;

class InviteController extends Controller
{

	public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
    	return view('admin.invite.index');
    }

    public function store(Request $res)
    {
    	
    	$data = array();
    	$obj_user = auth()->user();

    	if($res->has('user_csv'))
    	{
	    	$path = $res->file('user_csv');
	    	$data = array_filter(array_map('str_getcsv', file($path)));
	    	$data = array_map('array_filter', $data);
			$data = array_values(array_filter($data));

			if($res->name !=null and !empty($res->name) and $res->email !=null and !empty($res->email) )
			{
				$this->validate($res,[
	    		  'email' => 'required|email',
	    		]);

				$data[] = array(
					$res->name,
					$res->email
				);
			}

			$data = array_map("unserialize", array_unique(array_map("serialize", $data)));

	    	if(!empty($data))
	    	{
	    		
	    		$j=0;

	    		foreach ($data as $key => $d) {

	    		  $user_data['name'] = $d[0];
	    		  $user_data['email'] = $d[0];
	    		  $user_data['invite_from'] = $obj_user->fullname();
	    		  $user_data['url'] = route('register').'?ref='.safe_b64encode($obj_user->url);
	    		  if($j==0)
	    		  {
	    		  	 $j++;
	    		  	 continue;
	    		  }

	    		  UserInvite::create([
	    		  	'name' => $d[0],
	    		  	'email' => $d[1],
	    		  ]);

	    		  Mail::to($d[1])->send(new InviteUser($user_data));

	    		  $j++;
	    		}

	    	  session()->flash('success','Successfully sent invitation.');
	    	}
	    	else
	    	{
	    	   session()->flash('error','Please upload proper csv file.');
	    	}

	    	return redirect()->route('admin.invite.index');
    	}
    	else
    	{
    		$this->validate($res,[
    		'name' => 'required',
    		'email' => 'required|email',
    		]);

			  $user_data['name'] = $res->name;
    		  $user_data['email'] = $res->email;
    		  $user_data['invite_from'] = $obj_user->fullname();	
    		  $user_data['url'] = route('register').'?ref='.safe_b64encode(auth()->user()->url);

    		  UserInvite::create([
	    		  	'name' => $res->name,
	    		  	'email' => $res->email,
	    	  ]);

	    	 Mail::to($res->email)->send(new InviteUser($user_data));

	    	 session()->flash('success','Successfully sent invitation.');

	    	 return redirect()->route('admin.invite.index');
    	}
    	
    }
}

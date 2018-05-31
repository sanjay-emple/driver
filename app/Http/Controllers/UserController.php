<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data =array();
        $data['page_title'] = "User Lists";
        return view('admin.user.index',$data);
    }

    public function ajax_get_users()
    {
        $users = User::select(['id', 'name', 'first_name','last_name', 'email', 'telephone','driver_status','active','created_at'])->where('id','<>',1)->orderBy('id','desc');
        return Datatables::of($users)
        ->addIndexColumn()
         ->editColumn('name', function ($user) {
                return ucfirst($user->first_name.' '.$user->last_name);
            })
         ->editColumn('driver_status', function ($user) {
              $driver_status = $user->driver_status == 1 ? ['Active','primary'] : ['Inactive','warning'];  
              return '<span class="label label-'.$driver_status[1].'">'.$driver_status[0].'<span>';
            })
         ->editColumn('active', function ($user) {

              $user_status = $user->active == 1 ? ['Active','primary'] : ['Inactive','warning'];  
              return '<span class="label label-'.$user_status[1].'">'.$user_status[0].'<span>';

            })
         ->addColumn('action', function ($user) {

                $user_status = $user->active == 0 ? 'Approve': 'Reject';
                   $html = '<div class="btn-group">
                        <button type="button" class="btn btn-info dropdown-toggle waves-effect waves-light" data-toggle="dropdown" aria-expanded="false">Action <span class="caret"></span></button>
                        <div class="dropdown-menu">';
                     
                     $html .= '<a class="dropdown-item" href="'.route('admin.user.activate',$user->id).'">'.$user_status.'</a>';

                     $html .= '<a class="dropdown-item" href="'.route('admin.user.edit',$user->id).'">Edit</a>';
                    $html .= '</div></div>';

               return $html;
            })
       
        ->rawColumns(['driver_status','active','action'])
        ->make();
    }

    public function activate_user(Request $res,$user_id)
    {
       $user_m = User::find($user_id);

       if($user_m->active == 1)
       {
          $user_m->update(['active'=>'0']);
          session()->flash('success','User rejected successfully.');
          return redirect()->route('admin.user.index');
       }
       else
       {
          $user_m->update(['active'=>'1']);
          session()->flash('success','User approved successfully.');
          return redirect()->route('admin.user.index');
       }
    }

    public function change_profile($user_id)
    {
        $user_m = User::find($user_id);

        if($user_m == null)
        {
          session()->flash('error','User not found');
        }

        $data = [];
        $data['user'] = $user_m;

        return view('admin.user.edit',$data);
    }

    public function store_profile(Request $res)
    {
        $this->validate($res,[
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'address' => 'required',
            'postcode' => 'required|min:3|max:20',
            'telephone' => 'required|min:3|max:20',
            'email' => 'required|string|email|max:255|unique:users,email,'.$res->user_id,
            'status' => 'required',
            'driver_status' => 'required',
        ]);


        $user = User::find($res->user_id);

        if($user == null)
        {
           session()->flash('error','User not found');
           return redirect()->back();
        }

        $user->update([
            'first_name' => $res->first_name,
            'last_name' => $res->last_name,
            'city' => $res->city,
            'address' => $res->address,
            'email' => $res->email,
            'postcode' => $res->postcode,
            'telephone' => $res->telephone,
            'active' => $res->status,
            'driver_status' => $res->driver_status  
        ]);

       session()->flash('success','Driver details updated successfully');
       return redirect()->back();
    }

    public function change_password_form(Request $res)
    {
        $users = user::orderby('name')->get();
        $data = [];
        $data['users'] = $users;

        return view('admin.user.change_password',$data);
    }

    public function change_password(Request $res)
    {
       $this->validate($res,[
          'user' => 'required',
          'password' => 'required|min:6|confirmed|max:255'
       ],[
          'user.required' => "Please select driver."
       ]);


       $user = User::find($res->user);

       if($user == null)
       {
         session()->flash('error','Driver not found.');
         return rediect()->back();
       }

       $user->update([
          'password' => bcrypt($res->password)
       ]);

       session()->flash('success','Password change successfully.');

       return redirect()->back();
    }
}

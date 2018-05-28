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
              $driver_status = $user->driver_status == 1 ? ['Active','primary'] : ['InActive','warning'];  
              return '<span class="label label-'.$driver_status[1].'">'.$driver_status[0].'<span>';
            })
         ->editColumn('active', function ($user) {

              $user_status = $user->active == 1 ? ['Active','primary'] : ['InActive','warning'];  
              return '<span class="label label-'.$user_status[1].'">'.$user_status[0].'<span>';

            })
         ->addColumn('action', function ($user) {

                $user_status = $user->active == 0 ? 'Approve': 'Reject';
                   $html = '<div class="btn-group">
                        <button type="button" class="btn btn-info dropdown-toggle waves-effect waves-light" data-toggle="dropdown" aria-expanded="false">Action <span class="caret"></span></button>
                        <div class="dropdown-menu">';
                     
                     $html .= '<a class="dropdown-item" href="'.route('admin.user.activate',$user->id).'">'.$user_status.'</a>';

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
}

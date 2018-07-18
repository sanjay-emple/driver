<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\level_settings;
use Yajra\DataTables\Facades\DataTables;
use File;
use Image;
use App\Tree;
use DB; 
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
	
		
		
        $users = User::select(['id', 'name', 'driver_num', 'first_name','last_name', 'email', 'telephone','driver_status','active','created_at'])->where('id','<>',1)->where('active','!=','2')->orderBy('id','desc');
        return Datatables::of($users)
        ->addIndexColumn()
         ->editColumn('name', function ($user) {
                $name = ucfirst($user->first_name.' '.$user->last_name);
                $url = route('dashboard').'?user_id='.$user->id;
               return '<a href="'.$url.'">'.$name.'</a>';
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
		 
		        $drivers = Tree::get()->toArray();
				$trees = buildTree($drivers,$user->id);
				
                $user_status = $user->active == 0 ? 'Approve': 'Reject';
                   $html = '<div class="btn-group">
                        <button type="button" class="btn btn-info dropdown-toggle waves-effect waves-light" data-toggle="dropdown" aria-expanded="false">Action <span class="caret"></span></button>
                        <div class="dropdown-menu">';
                     
                     $html .= '<a class="dropdown-item" href="'.route('admin.user.activate',$user->id).'">'.$user_status.'</a>';

                     $html .= '<a class="dropdown-item" href="'.route('admin.user.edit',$user->id).'">Edit</a>';
					 	
					 if(count($trees) > 0 ){
                        $html .= '<a class="dropdown-item" onclick="deleteDriver(0)">Delete</a>';
					 }else{
						
						
						$html .= '<a class="dropdown-item" onclick="deleteDriver(\''.$user->id.'\',\''.getFullNameById($user->id).'\')">Delete</a>';	 
					 }
                    $html .= '</div></div>';

               return $html;
            })
       
        ->rawColumns(['name','active','action'])
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
	
	/*
		FunctionBy:		Sanjay Yadav
		Description:	Delete Single Driver, The parent cannot be deleted until they have a child.
		Date:			18.07.2018
	*/
	
	public function setDriverlevel_form(Request $res)
    {
		$levels = DB::table('level_settings')->get();
		$data = [];
        $data['levels'] = $levels;
		
        return view('admin.user.level_settings',$data);
		
    }
	
	public function updateDriverlevel(Request $res)
	{
		$levelId		=	$res['level_id'];
		$levelNumber	=	$res['level_number'];
		$this->validate($res,[
			'level_number' => 'required|numeric',
		],[
			'level_number.required' => "Please Enter level Number."
		]);

		
	   if(!empty($res['level_id']))
	   {
		   $ab  = DB::table('level_settings')->where('level_id',$levelId)->update(['level_number' => $levelNumber]);
	   }
	   else
	   {
		  
		DB::table('level_settings')->insert(
			['level_number' => $levelNumber, 'status' => '1', 'created_at'=> date('Y-m-d H:i:s'), 'updated_at'=> date('Y-m-d H:i:s')]
		);
	   }
	   
		session()->flash('success','Level Number change successfully.');

       return redirect()->back(); 
	}
	
	
	/*
		FunctionBy:		Sanjay Yadav
		Description:	Set Deriver level.Admin Can set the visibility of tree level for the driver.
		Date:			18.07.2018
	*/
	
	public function deleteDriver()
    {
		
		$id = $_POST['id'];
	   
		// Description:	Tree:: Delete Driver from tree 
		$treeTable  = Tree::where('user_id', $id)
						->update(['status' => '2']);
		
		// Description:	User:: Delete Driver from user 
        $user_m = User::find($id);
	   
	    $success = $user_m->update(['active'=>'2']);
	    session()->flash('success','User Deleted successfully.');
	    if($success){
			return 1;
		}else{
			return 0;
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

        $rules = [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'address' => 'required',
            'postcode' => 'required|min:3|max:20',
            'telephone' => 'required|min:3|max:20',
            'email' => 'required|string|email|max:255|unique:users,email,'.$res->user_id,
            'status' => 'required',
            'driver_status' => 'required',
            'driver_number' => 'required|string|max:255|unique:users,driver_num,'.$res->user_id,
        ];

        if($res->has('photo'))
        {
           $rules = array_merge($rules,[
              'photo' => 'required|mimes:jpeg,jpg,png' 
           ]);
        } 

        
        $this->validate($res,$rules);


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

        if($res->has('photo'))
        {

            if($user->profile_img)
            {
              $profile_image_path = $path = public_path('uploads/profile_image/' .$user->profile_img);

               File::delete($profile_image_path);
            }
  
            $image = $res->file('photo');
            $filename  = time() . '.' . $image->getClientOriginalExtension();
            $path = public_path('uploads/profile_image/' . $filename);
            Image::make($image->getRealPath())->resize(128, 128)->save($path);
            $user->profile_img = $filename;
            $user->save();
        }



       session()->flash('success','Driver details updated successfully');
       return redirect()->back();
    }

    public function change_password_form(Request $res)
    {
        $users = user::orderby('driver_num')->get();
        $data = [];
        $data['users'] = $users;

        return view('admin.user.change_password',$data);
    }
	public function change_password_formm(Request $res)
    {
        $users = user::orderby('driver_num')->get();
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

    public function profile_image_form()
    {
       $user = auth()->user();

       $data['user'] = $user;

       return view('comman.profile_img',$data);
    }

    public function profile_image_store(Request $res)
    {

        $this->validate($res,
          [
             'photo' => 'required|mimes:jpeg,jpg,png' 
          ]
        );

        $user = auth()->user();

        if($user->profile_img)
            {
              $profile_image_path = $path = public_path('uploads/profile_image/' .$user->profile_img);

               File::delete($profile_image_path);
            }
  
            $image = $res->file('photo');
            $filename  = time() . '.' . $image->getClientOriginalExtension();
            $path = public_path('uploads/profile_image/' . $filename);
            Image::make($image->getRealPath())->resize(128, 128)->save($path);
            $user->profile_img = $filename;
            $user->save();

        session()->flash('success','Profile image successfully.');

        return redirect()->back();
    }

    public function change_position_form(Request $res)
    {
        $users = User::join('tree','users.id','tree.user_id')->select('users.*','tree.id as tree_id','tree.parent_id')->get();
        $data = [];
        $data['users'] = $users;

        //dd($users);

        return view('admin.tree.change_pos',$data);
    }

    public function change_position_store(Request $res)
    {
       dump($res->from);
       $tree = Tree::where('parent_id','2')->get()->toArray();

       dd($tree);
    }



}

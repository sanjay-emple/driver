<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Tree;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }   

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $res)
    {
        $data = array();
        $user_count = User::where('id','<>','1')->count();
        $loginid = auth()->id();
        $tobj = Tree::where('user_id',$loginid)->first();
        $drivers = Tree::get()->toArray();
        $trees = buildTree($drivers,auth()->user()->id);
        $tree_user_id = $res->user_id;    

        $data['has_tree'] = $tobj == null ? false : true;
        $data['user_count'] = $user_count;
        $data['user_obj'] = auth()->user();
        $data['users_trees']= $trees;
        $data['loginid']= $loginid;
        $data['drivers']= $drivers;
        $data['users_arr']= User::where('id','<>',1)->get()->toArray();
        $data['tree_user_id']= $tree_user_id;
       

       // dd($data['users']);

        if(auth()->user()->id == 1)
        {

            return view('admin.dashboard.index',$data);
        }
        else
        {
            return view('user.dashboard.index',$data);
        }

        
    }
}

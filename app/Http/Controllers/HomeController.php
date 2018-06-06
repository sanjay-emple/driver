<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
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
    public function index()
    {
        $data = array();
        $user_count = User::where('id','<>','1')->count();
        $data['user_count'] = $user_count;
        $data['user_obj'] = auth()->user();

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

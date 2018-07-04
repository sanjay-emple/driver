<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Tree;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/register';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'address' => 'required',
            'postcode' => 'required|min:3|max:20',
            'telephone' => 'required|min:3|max:20',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'g-recaptcha-response' => 'required|captcha',

        ],
         [ 'g-recaptcha-response.required' => 'Please verify that you are not a robot.',
            'g-recaptcha-response.captcha' => 'Captcha error! try again later or contact site admin.'
         ]
        ); 
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {

        $ramdom_string = random_string(8);
        $driver_num = random_num(8);

        $user  = User::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'city' => $data['city'],
            'address' => $data['address'],
            'postcode' => $data['postcode'],
            'telephone' => $data['telephone'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'url' => $ramdom_string,
            'driver_num' => $driver_num
        ]); 

        $ref_code = safe_b64decode($data['ref_code']);

        $ref_user = User::where('url',$ref_code)->first();

        if($ref_user != null)
        {

            if($ref_user->id == 1)
            {
                Tree::create([
                   'user_id' => $user->id,
                   'parent_id' => 0,
                   'level' => null
                ]);
            }
            else
            {
                $tree_m = Tree::where('parent_id',$ref_user->id)->orderBy('id','desc')->first();

                if($tree_m == null)
                {
                   $pos = 1;
                }
                else
                {
                   $level = $tree_m['level'];

                   $pos = $level == 1 ? 2 : 1;
                }

                Tree::create([
                   'user_id' => $user->id,
                   'parent_id' => $ref_user->id,
                   'level' => $pos
                ]);
            }
                
        }

        return $user;

    }

    /**
     * The user has been registered.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function registered(Request $request, $user)
    {
        $this->guard()->logout();

        return redirect(route('thankyou'));
        // $url = route('register').'?ref='.$request->ref_code;
        // return redirect($url)
        //     ->withSuccess('Your request is send to admin for approval.');
    }

    public function showRegistrationForm(Request $res)
    {
       
        $ref_code = $res->ref;

        if($ref_code == null or empty($ref_code))
        {
            return redirect('/');
        }

        $data = [];
        $data['ref_code'] = $ref_code;

        $ref_code = safe_b64decode($ref_code);

        $user_m = User::where('url',$ref_code)->first();

        if($user_m == null)
        {
            session()->flash('error','Invalid referral code');
            $url = route('login');
            return redirect($url);
        }
        
        //uy72nxwr
        return view('auth.register',$data);
    }

    public function thankyou(){
        return view('auth.thankyou');
    }
}

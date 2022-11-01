<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Artisan;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */
    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::DASHBOARD;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    public function csLogin(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return response()->json(['success' => 'Successfully logged in!']);
        }
        elseif(Auth::attempt(['username' => $request->email, 'password' => $request->password]))
        {
            return response()->json(['success' => 'Successfully logged in!']);
        }
        elseif(Auth::attempt(['mobile_no' => $request->email, 'password' => $request->password]))
        {
            return response()->json(['success' => 'Successfully logged in!']);
        }
        return response()->json(['error' => 'Please Enter Valid Credential!']);
    }

    /*public function index()
    {
        $user = Auth::user();
        dd($user);

        dd(Auth::user()->role_id);
        if(Auth::user()->role_id == 1){
            // Superadmi dashboard        
            return view('dashboard.superadmin');

        }elseif(Auth::user()->role_id == 5){
            // DC office assistant dashboard            
            return view('dashboard.do_asst');
        }
    }
    */
}

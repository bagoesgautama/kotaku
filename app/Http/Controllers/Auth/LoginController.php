<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;
use Validator;
use Redirect;
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

	/*protected function authenticated(Request $request, $user)
	{
	return redirect('/index');
}*/
    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/index';

    /**
     * Create a new controller instance.
     *
     * @return void
     */


    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm()
    {
        return view('login');
		echo 'asdasdsa';
    }

	public function authenticate()
	{
		return view('login');
		echo 'asdasdsa';
	}
	public function login(Request $request){
		// Creating Rules for Email and Password
		$rules = array(
			'email' => 'required', // make sure the email is an actual email
			'password' => 'required|alphaNum|min:8'
		);
		// password has to be greater than 3 characters and can only be alphanumeric and);
		// checking all field
		$validator = Validator::make($request->all() , $rules);

		// if the validator fails, redirect back to the form

		if ($validator->fails())
		{
			return Redirect::to('login')->withErrors($validator) // send back all errors to the login form
			->withInput($request->input('email')); // send back the input (not the password) so that we can repopulate the form
		}
	  	else
		{
			// create our user data for the authentication
			$userdata = array(
				'email' => $request->input('email') ,
				'password' => $request->input('password')
			);

			// attempt to do the login
			if (Auth::attempt($userdata))
			{
				Auth::user()->setAttribute('role','master');
				return Redirect::to('index');
			}
		  	else
			{
				return Redirect::to('login');
			}
		}
	}

    public function index()
    {
       return view('login');
    }
	public function logout(Request $request) {
		Auth::logout();
		return redirect('/login');
	}
}

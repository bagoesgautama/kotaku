<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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
    protected $redirectTo = '/';

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
    }

	function doLogin()
	{
		// Creating Rules for Email and Password
		$rules = array(
			'email' => 'required|email', // make sure the email is an actual email
			'password' => 'required|alphaNum|min:8'

		// password has to be greater than 3 characters and can only be alphanumeric and);
		// checking all field

		$validator = Validator::make(Input::all() , $rules);

		// if the validator fails, redirect back to the form

		if ($validator->fails())
			{
			return Redirect::to('login')->withErrors($validator) // send back all errors to the login form
			->withInput(Input::except('password')); // send back the input (not the password) so that we can repopulate the form
			}
		  else
			{

			// create our user data for the authentication

			$userdata = array(
				'email' => Input::get('email') ,
				'password' => Input::get('password')
			);

			// attempt to do the login

			if (Auth::attempt($userdata))
				{

				return Redirect::to('index');

				}
			  else
				{

				// validation not successful, send back to form
				return Redirect::to('checklogin');
				}
			}
		}
	}

    public function index()
    {
       return view('index');
    }
}

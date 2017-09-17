<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

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
        // parent::__construct();
    }

    /**
     * Show the application dashboard.
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['username'] = '';
	    if (Auth::check()) {
            $user = Auth::user();
            $data['username'] = Auth::user()->name;
        }
		return view('module',$data);
    }

	public function hrm()
	{
		$data['username'] = '';
		if (Auth::check()) {
			$user = Auth::user();
			$data['username'] = Auth::user()->name;
		}
		return view('HRM/main/index',$data);
	}

	public function main()
	{
		$data['username'] = '';
		if (Auth::check()) {
			$user = Auth::user();
			$data['username'] = Auth::user()->name;
		}
		return view('MAIN/main/index',$data);
	}

	public function map()
	{
		$data['username'] = '';
		if (Auth::check()) {
			$user = Auth::user();
			$data['username'] = Auth::user()->name;
		}
		return view('google_maps',$data);
	}

    public function logout()
    {
        Auth::logout();
    }
}

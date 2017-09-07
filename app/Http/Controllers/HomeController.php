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
        //$this->middleware('auth');
        // parent::__construct();
    }

    /**
     * Show the application dashboard.
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['username'] = '';
		//$data['test']=true;
        if (Auth::check()) {
            $user = Auth::user();
            $data['username'] = Auth::user()->name;
        }

        return view('horizontal_menu',$data);
    }

    public function logout()
    {
        Auth::logout();
    }
}

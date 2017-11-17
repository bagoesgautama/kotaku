<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Redirect;
use Mail;

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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$akses= Auth::user()->menu()->get();
		if(count($akses) > 0){
			foreach ($akses as $item) {
				$data['apps'][$item->kode_apps] =  'a' ;
				//if($item->kode_menu==10)
					//$data['detil'][$item->kode_menu_detil]='a';
			}
			if(!empty($data['apps'])){
				/*Mail::raw('Text to e-mail', function($message){
					$message->from('kotakudemo@gmail.com', 'Sim');
    				$message->to('ricky.yuliadi@gmail.com')->cc('ricky@alutechno.io');
				})*/;
			    return view('module',$data);
			}
			else {
				return Redirect::to('/logout');
			}
		}else{
			return Redirect::to('/logout');
		}
    }

	public function hrm()
	{
		$user = Auth::user();
		$akses= $user->menu()->where('kode_apps', 2)->get();
		if(count($akses) > 0){
			foreach ($akses as $item) {
				$data['menu'][$item->kode_menu] =  'a' ;
				//if($item->kode_menu==10)
					//$data['detil'][$item->kode_menu_detil]='a';
			}
			if(!empty($data['menu'])){
			    $data['username'] = $user->name;
				return view('HRM/main/index',$data);
			}
			else {
				return Redirect::to('/');
			}
		}else{
			return Redirect::to('/');
		}
	}

	public function inbox()
	{
		$data['user'] = Auth::user();
		$data['pesan'] = DB::select('select a.kode,a.text_pesan,a.tgl_pesan_masuk,concat(b.nama_depan," ",b.nama_belakang) nama from bkt_02030205_pesan a left join bkt_02010111_user b on a.kode_user_pengirim=b.id where a.kode_user='.$data['user']->id.' and status=0 order by a.kode desc');
		echo json_encode($data);
	}

	public function qs()
	{
		$user = Auth::user();
		$akses= $user->menu()->where('kode_apps', 5)->get();
		if(count($akses) > 0){
			foreach ($akses as $item) {
				$data['menu'][$item->kode_menu] =  'a' ;
				//if($item->kode_menu==10)
					//$data['detil'][$item->kode_menu_detil]='a';
			}
			if(!empty($data['menu'])){
			    $data['username'] = $user->name;
				return view('QS/main/index',$data);
			}
			else {
				return Redirect::to('/');
			}
		}else{
			return Redirect::to('/');
		}
	}

	public function main()
	{
		$user = Auth::user();
        $akses= $user->menu()->where('kode_apps', 1)->get();
		if(count($akses) > 0){
			foreach ($akses as $item) {
				$data['menu'][$item->kode_menu] =  'a' ;
				//if($item->kode_menu==10)
					//$data['detil'][$item->kode_menu_detil]='a';
			}
			if(!empty($data['menu'])){
			    $data['username'] = $user->name;
				return view('MAIN/main/index',$data);
			}
			else {
				return Redirect::to('/');
			}
		}else{
			return Redirect::to('/');
		}
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

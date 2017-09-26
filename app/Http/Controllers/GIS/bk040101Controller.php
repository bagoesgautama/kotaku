<?php

namespace App\Http\Controllers\GIS;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Redirect;

class bk040101Controller extends Controller
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
		$rowData = DB::select('select * from bkt_01010101_prop where status=1 and url_border_area is not null');
		$data['prop']=$rowData;
		return view('GIS/bk040101/index',$data);
    }

	public function kota(Request $request)
    {
		$id=$request->input('id');
		$data['username'] = '';
		if (Auth::check()) {
			$user = Auth::user();
			$data['username'] = Auth::user()->name;
		}
		$rowData = DB::select('select * from bkt_01010101_prop where status=1 and kode='.$id);
		$data['propinsi']=$rowData[0]->nama;
		$rowData = DB::select('select * from bkt_01010102_kota where status=1 and url_border_area is not null and kode_prop='.$id);
		$data['prop']=$rowData;
		//echo json_encode($data['prop']);
		return view('GIS/bk040101/kota',$data);
    }
}

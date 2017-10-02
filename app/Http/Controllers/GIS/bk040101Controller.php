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
		return view('GIS/bk040101/kota',$data);
    }

	public function kecamatan(Request $request)
    {
		$id=$request->input('id');
		$data['username'] = '';
		if (Auth::check()) {
			$user = Auth::user();
			$data['username'] = Auth::user()->name;
		}
		$rowData = DB::select('select b.nama prop,a.* from bkt_01010102_kota a,bkt_01010101_prop b where a.kode_prop=b.kode and a.status=1 and a.kode='.$id);
		$data['propinsi']=$rowData[0]->prop;
		$data['kode_propinsi']=$rowData[0]->kode_prop;
		$data['kota']=$rowData[0]->nama;
		$rowData = DB::select('select * from bkt_01010103_kec where status=1 and url_border_area is not null and kode_kota='.$id);
		$data['prop']=$rowData;
		return view('GIS/bk040101/kecamatan',$data);
    }
	public function kelurahan(Request $request)
    {
		$id=$request->input('id');
		$data['username'] = '';
		if (Auth::check()) {
			$user = Auth::user();
			$data['username'] = Auth::user()->name;
		}
		$rowData = DB::select('select b.nama kota,a.* from bkt_01010103_kec a,bkt_01010101_prop b where a.kode_prop=b.kode and a.status=1 and a.kode='.$id);
		$data['propinsi']=$rowData[0]->prop;
		$data['kode_propinsi']=$rowData[0]->kode_prop;
		$data['kota']=$rowData[0]->nama;
		$rowData = DB::select('select * from bkt_01010103_kec where status=1 and url_border_area is not null and kode_kota='.$id);
		$data['prop']=$rowData;
		return view('GIS/bk040101/kelurahan',$data);
    }
}

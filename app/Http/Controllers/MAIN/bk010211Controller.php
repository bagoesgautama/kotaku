<?php

namespace App\Http\Controllers\MAIN;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Redirect;

class bk010211Controller extends Controller
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
	    if (Auth::check()) {
            $user = Auth::user();
            $data['username'] = Auth::user()->name;
        }
		return view('MAIN/bk010211/index',$data);
    }

	public function show()
	{
		//$users = DB::select('select * from users ');
		//echo json_encode($users);
		$data['username'] = '';
		$data['test']=true;
		if (Auth::check()) {
			$user = Auth::user();
			$data['username'] = Auth::user()->name;
		}
		return view('slum_program',$data);
	}

	public function Post(Request $request)
	{
		$columns = array(
			0 =>'tahun',
			1 =>'kode_kota',
			2 =>'jenis_kegiatan',
			3 =>'tgl_kegiatan',
			4 =>'lok_kegiatan'
		);
		$query='select bkt_01020206_sos_rel_kota.kode, bkt_01010102_kota.nama as kode_kota, bkt_01020206_sos_rel_kota.jenis_kegiatan, bkt_01020206_sos_rel_kota.tgl_kegiatan, bkt_01020206_sos_rel_kota.lok_kegiatan from bkt_01020206_sos_rel_kota inner join bkt_01010102_kota on bkt_01020206_sos_rel_kota.kode_kota = bkt_01010102_kota.kode';
		$totalData = DB::select('select count(1) cnt from bkt_01020206_sos_rel_kota ');
		$totalFiltered = $totalData[0]->cnt;
		$limit = $request->input('length');
		$start = $request->input('start');
		$order = $columns[$request->input('order.0.column')];
		$dir = $request->input('order.0.dir');
		if(empty($request->input('search.value')))
		{
			$posts=DB::select($query .' order by bkt_01020206_sos_rel_kota.'.$order.' '.$dir.' limit '.$start.','.$limit);
		}
		else {
			$search = $request->input('search.value');
			$posts=DB::select($query. ' and bkt_01020206_sos_rel_kota.tahun like "%'.$search.'%" or bkt_01010102_kota.nama like "%'.$search.'%" or bkt_01020206_sos_rel_kota.jenis_kegiatan like "%'.$search.'%" or bkt_01020206_sos_rel_kota.tgl_kegiatan like "%'.$search.'%" or bkt_01020206_sos_rel_kota.lok_kegiatan like "%'.$search.'%" order by '.$order.' '.$dir.' limit '.$start.','.$limit);
			$totalFiltered=DB::select('select count(1) from ('.$query. ' and bkt_01020206_sos_rel_kota.tahun like "%'.$search.'%" or bkt_01010102_kota.nama like "%'.$search.'%" or bkt_01020206_sos_rel_kota.jenis_kegiatan like "%'.$search.'%" or bkt_01020206_sos_rel_kota.tgl_kegiatan like "%'.$search.'%" or bkt_01020206_sos_rel_kota.lok_kegiatan like "%'.$search.'%") a');
		}

		$data = array();
		if(!empty($posts))
		{
			foreach ($posts as $post)
			{
				$show =  $post->kode;
				$edit =  $post->kode;
				$delete = $post->kode;
				$jenis_kegiatan = null;

				if($post->jenis_kegiatan == '2.4.1'){
					$jenis_kegiatan = 'Sosialisasi Tingkat Kota';
				}elseif($post->jenis_kegiatan == '2.4.2'){
					$jenis_kegiatan = 'Relawan Kota';
				}

				$url_edit=url('/')."/main/persiapan/kota/kegiatan/sosialisasi/create?kode=".$edit;
				$url_delete=url('/')."/main/persiapan/kota/kegiatan/sosialisasi/delete?kode=".$delete;
				$nestedData['tahun'] = $post->tahun;
				$nestedData['kode_kota'] = $post->kode_kota;
				$nestedData['jenis_kegiatan'] = $jenis_kegiatan;
				$nestedData['tgl_kegiatan'] = $post->tgl_kegiatan;
				$nestedData['lok_kegiatan'] = $post->lok_kegiatan;
				$nestedData['option'] = "&emsp;<a href='{$url_edit}' title='EDIT' ><span class='fa fa-fw fa-edit'></span></a>
				                          &emsp;<a href='#' onclick='delete_func(\"{$url_delete}\");'><span class='fa fa-fw fa-trash-o'></span></a>";
				$data[] = $nestedData;
			}
		}

		$json_data = array(
					"draw"            => intval($request->input('draw')),
					"recordsTotal"    => intval($totalData[0]->cnt),
					"recordsFiltered" => intval($totalFiltered),
					"data"            => $data
					);

		echo json_encode($json_data);
	}

	public function create(Request $request)
	{
		$data['username'] = '';
		$data['test']=true;
		$data['kode']=$request->input('kode');
		if($data['kode']!=null){
			$rowData = DB::select('select * from bkt_01020206_sos_rel_kota where kode='.$data['kode']);
			$data['tahun'] = $rowData[0]->tahun;
			$data['kode_kota'] = $rowData[0]->kode_kota;
			$data['kode_korkot'] = $rowData[0]->kode_korkot;
			$data['kode_kec'] = $rowData[0]->kode_kec;
			$data['jenis_kegiatan'] = $rowData[0]->jenis_kegiatan;
			$data['tgl_kegiatan'] = $rowData[0]->tgl_kegiatan;
			$data['lok_kegiatan'] = $rowData[0]->lok_kegiatan;
			$data['q_peserta_p'] = $rowData[0]->q_peserta_p;
			$data['q_peserta_w'] = $rowData[0]->q_peserta_w;
			$data['diser_tgl'] = $rowData[0]->diser_tgl;
			$data['diser_oleh'] = $rowData[0]->diser_oleh;
			$data['diket_tgl'] = $rowData[0]->diket_tgl;
			$data['diket_oleh'] = $rowData[0]->diket_oleh;
			$data['diver_tgl'] = $rowData[0]->diver_tgl;
			$data['diver_oleh'] = $rowData[0]->diver_oleh;
			$data['created_time'] = $rowData[0]->created_time;
			$data['created_by'] = $rowData[0]->created_by;
			$data['updated_time'] = $rowData[0]->updated_time;
			$data['updated_by'] = $rowData[0]->updated_by;
		}else{
			$data['tahun'] = null;
			$data['kode_kota'] = null;
			$data['kode_korkot'] = null;
			$data['kode_kec'] = null;
			$data['jenis_kegiatan'] = null;
			$data['tgl_kegiatan'] = null;
			$data['lok_kegiatan'] = null;
			$data['q_peserta_p'] = null;
			$data['q_peserta_w'] = null;
			$data['diser_tgl'] = null;
			$data['diser_oleh'] = null;
			$data['diket_tgl'] = null;
			$data['diket_oleh'] = null;
			$data['diver_tgl'] = null;
			$data['diver_oleh'] = null;
			$data['created_time'] = null;
			$data['created_by'] = null;
			$data['updated_time'] = null;
			$data['updated_by'] = null;
		}
		if (Auth::check()) {
			$user = Auth::user();
			$data['username'] = Auth::user()->name;
		}
		$data['kode_kota_list'] = DB::select('select * from bkt_01010102_kota where status=1');
		$data['kode_korkot_list'] = DB::select('select * from bkt_01010111_korkot');
		$data['kode_kec_list'] = DB::select('select * from bkt_01010103_kec where status=1');
		return view('MAIN/bk010208/create',$data);
	}

	public function post_create(Request $request)
	{
		if ($request->input('kode')!=null){
			date_default_timezone_set('Asia/Jakarta');
			DB::table('bkt_01020206_sos_rel_kota')->where('kode', $request->input('kode'))
			->update([
				'tahun' => $request->input('tahun-input'),
				'kode_kota' => $request->input('kode-kota-input'),
				'kode_korkot' => $request->input('kode-korkot-input'), 
				'kode_kec' => $request->input('kode-kec-input'),   
				'jenis_kegiatan' => $request->input('jns-kegiatan-input'), 
				'tgl_kegiatan' => $request->input('tgl-kegiatan-input'), 
				'lok_kegiatan' => $request->input('lok-kegiatan-input'),
				'q_peserta_p' => $request->input('q-laki-input'),
				'q_peserta_w' => $request->input('q-perempuan-input'),
				'diser_tgl' => $this->date_conversion($request->input('tgl-diser-input')),
				'diser_oleh' => $request->input('diser-oleh-input'),
				'diket_tgl' => $this->date_conversion($request->input('tgl-diket-input')),
				'diket_oleh' => $request->input('diket-oleh-input'),
				'diver_tgl' => $this->date_conversion($request->input('tgl-diver-input')),
				'diver_oleh' => $request->input('diver-oleh-input'),
				'updated_by' => Auth::user()->id, 
				'updated_time' => date('Y-m-d H:i:s')
				]);

		}else{
			DB::table('bkt_01020206_sos_rel_kota')->insert([
				'tahun' => $request->input('tahun-input'),
				'kode_kota' => $request->input('kode-kota-input'),
				'kode_korkot' => $request->input('kode-korkot-input'), 
				'kode_kec' => $request->input('kode-kec-input'),   
				'jenis_kegiatan' => $request->input('jns-kegiatan-input'), 
				'tgl_kegiatan' => $this->date_conversion($request->input('tgl-kegiatan-input')), 
				'lok_kegiatan' => $request->input('lok-kegiatan-input'),
				'q_peserta_p' => $request->input('q-laki-input'),
				'q_peserta_w' => $request->input('q-perempuan-input'),
				'diser_tgl' => $this->date_conversion($request->input('tgl-diser-input')),
				'diser_oleh' => $request->input('diser-oleh-input'),
				'diket_tgl' => $this->date_conversion($request->input('tgl-diket-input')),
				'diket_oleh' => $request->input('diket-oleh-input'),
				'diver_tgl' => $this->date_conversion($request->input('tgl-diver-input')),
				'diver_oleh' => $request->input('diver-oleh-input'),
				'created_by' => Auth::user()->id
       			]);
		}
	}

	public function date_conversion($date)
	{
        $date_convert = date('Y-m-d', strtotime($date));
        return $date_convert;
	}

	public function delete(Request $request)
	{
		DB::table('bkt_01020206_sos_rel_kota')->where('kode', $request->input('kode'))->delete();
        return Redirect::to('/main/persiapan/kota/kegiatan/sosialisasi');
    }
}

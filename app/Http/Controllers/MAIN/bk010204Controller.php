<?php

namespace App\Http\Controllers\MAIN;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Redirect;

class bk010204Controller extends Controller
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
		return view('MAIN/bk010204/index',$data);
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
			0 =>'kode_pokja',
			1 =>'jenis_subkegiatan',
			2 =>'tgl_kegiatan',
			3 =>'lok_kegiatan'
		);
		$query='select bkt_01020203_fungsi_pokja.kode, bkt_01020203_fungsi_pokja.kode_pokja, bkt_01020203_fungsi_pokja.jenis_subkegiatan, bkt_01020203_fungsi_pokja.tgl_kegiatan, bkt_01020203_fungsi_pokja.lok_kegiatan from bkt_01020203_fungsi_pokja inner join bkt_01020202_pokja on bkt_01020203_fungsi_pokja.kode_pokja = bkt_01020202_pokja.kode where bkt_01020202_pokja.jenis_kegiatan = 2.2';
		$totalData = DB::select('select count(1) cnt from bkt_01020203_fungsi_pokja ');
		$totalFiltered = $totalData[0]->cnt;
		$limit = $request->input('length');
		$start = $request->input('start');
		$order = $columns[$request->input('order.0.column')];
		$dir = $request->input('order.0.dir');
		if(empty($request->input('search.value')))
		{
			$posts=DB::select($query .' order by bkt_01020203_fungsi_pokja.'.$order.' '.$dir.' limit '.$start.','.$limit);
		}
		else {
			$search = $request->input('search.value');
			$posts=DB::select($query. ' and bkt_01020203_fungsi_pokja.kode_pokja like "%'.$search.'%" or bkt_01020203_fungsi_pokja.jenis_subkegiatan like "%'.$search.'%" or bkt_01020203_fungsi_pokja.tgl_kegiatan like "%'.$search.'%" or bkt_01020203_fungsi_pokja.lok_kegiatan like "%'.$search.'%" order by '.$order.' '.$dir.' limit '.$start.','.$limit);
			$totalFiltered=DB::select('select count(1) from ('.$query. ' and bkt_01020203_fungsi_pokja.kode_pokja like "%'.$search.'%" or bkt_01020203_fungsi_pokja.jenis_subkegiatan like "%'.$search.'%" or bkt_01020203_fungsi_pokja.tgl_kegiatan like "%'.$search.'%" or bkt_01020203_fungsi_pokja.lok_kegiatan like "%'.$search.'%") a');
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

				if($post->jenis_subkegiatan == '2.2.3.3'){
					$jenis_kegiatan = 'Pertemuan Rutin';
				}elseif($post->jenis_subkegiatan == '2.2.3.4'){
					$jenis_kegiatan = 'Monitoring';
				}

				$url_edit=url('/')."/main/persiapan/propinsi/pokja/kegiatan/create?kode=".$edit;
				$url_delete=url('/')."/main/persiapan/propinsi/pokja/kegiatan/delete?kode=".$delete;
				$nestedData['kode_pokja'] = $post->kode_pokja;
				$nestedData['jenis_subkegiatan'] = $jenis_kegiatan;
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
			$rowData = DB::select('select * from bkt_01020203_fungsi_pokja where kode='.$data['kode']);
			$data['kode_pokja'] = $rowData[0]->kode_pokja;
			$data['jenis_subkegiatan'] = $rowData[0]->jenis_subkegiatan;
			$data['tgl_kegiatan'] = $rowData[0]->tgl_kegiatan;
			$data['lok_kegiatan'] = $rowData[0]->lok_kegiatan;
			$data['q_anggota_p'] = $rowData[0]->q_anggota_p;
			$data['q_anggota_w'] = $rowData[0]->q_anggota_w;
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
			$data['kode_pokja'] = null;
			$data['jenis_subkegiatan'] = null;
			$data['tgl_kegiatan'] = null;
			$data['lok_kegiatan'] = null;
			$data['q_anggota_p'] = null;
			$data['q_anggota_w'] = null;
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
		$data['kode_pokja_list'] = DB::select('select * from bkt_01020202_pokja where jenis_kegiatan = 2.2');
		return view('MAIN/bk010204/create',$data);
	}

	public function post_create(Request $request)
	{
		if ($request->input('kode')!=null){
			date_default_timezone_set('Asia/Jakarta');
			DB::table('bkt_01020203_fungsi_pokja')->where('kode', $request->input('kode'))
			->update([
				'kode_pokja' => $request->input('kode-pokja-input'), 
				'jenis_subkegiatan' => $request->input('sub-kegiatan-input'), 
				'tgl_kegiatan' => $request->input('tgl-kegiatan-input'), 
				'lok_kegiatan' => $request->input('lok-kegiatan-input'),
				'q_anggota_p' => $request->input('q-laki-input'),
				'q_anggota_w' => $request->input('q-perempuan-input'),
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
			DB::table('bkt_01020203_fungsi_pokja')->insert([
				'kode_pokja' => $request->input('kode-pokja-input'), 
				'jenis_subkegiatan' => $request->input('sub-kegiatan-input'), 
				'tgl_kegiatan' => $request->input('tgl-kegiatan-input'), 
				'lok_kegiatan' => $request->input('lok-kegiatan-input'),
				'q_anggota_p' => $request->input('q-laki-input'),
				'q_anggota_w' => $request->input('q-perempuan-input'),
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
		DB::table('bkt_01020203_fungsi_pokja')->where('kode', $request->input('kode'))->delete();
        return Redirect::to('/main/persiapan/propinsi/pokja/kegiatan');
    }
}

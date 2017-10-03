<?php

namespace App\Http\Controllers\MAIN;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Redirect;

class bk010114Controller extends Controller
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
		return view('MAIN/bk010114/index',$data);
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
		return view('/main/kel_faskel',$data);
	}

	public function Post(Request $request)
	{
		$columns = array(
			0 =>'kode_kmp_slum_prog',
			1 =>'kode_faskel',
			2 =>'kode_kel',
			3 =>'blm',
			4 =>'jenis_project',
			5 =>'tahun_glossary',
			6 =>'tahun_project',
			7 =>'awal_project',
			8 =>'kode_ms',
			9 =>'kode_kec',
			10 =>'kode_kota',
			11 =>'kode_prop',
			12 =>'lokasi_blm',
			13 =>'Lokasi_kumuh',
			14 =>'flag_kumuh',
			15 =>'flag_lokasi_ppmk',
			16 =>'created_time',
			17 =>'created_by',
			18 =>'update_time',
			19 =>'update_by'
		);
		$query='select * from bkt_01010114_kel_faskel ';
		$totalData = DB::select('select count(1) cnt from bkt_01010114_kel_faskel ');
		$totalFiltered = $totalData[0]->cnt;
		$limit = $request->input('length');
		$start = $request->input('start');
		$order = $columns[$request->input('order.0.column')];
		$dir = $request->input('order.0.dir');
		if(empty($request->input('search.value')))
		{
			$posts=DB::select($query .' order by '.$order.' '.$dir.' limit '.$start.','.$limit);
		}
		else {
			$search = $request->input('search.value');
			$posts=DB::select($query. 'where name like "%'.$search.'%" or email like "%'.$search.'%" order by '.$order.' '.$dir.' limit '.$start.','.$limit);
			$totalFiltered=DB::select('select count(1) from ('.$query. 'where name like "%'.$search.'%" or email like "%'.$search.'%") a');
		}

		$data = array();
		if(!empty($posts))
		{
			foreach ($posts as $post)
			{
				$show =  $post->kode;
				$edit =  $post->kode;
				$delete = $post->kode;
				$url_edit=url('/')."/main/kel_faskel/create?kode=".$show;
				$url_delete=url('/')."/main/kel_faskel/delete?kode=".$delete;
				$nestedData['kode_kmp_slum_prog'] = $post->kode_kmp_slum_prog;
				$nestedData['kode_faskel'] = $post->kode_faskel;
				$nestedData['kode_kel'] = $post->kode_kel;
				$nestedData['blm'] = $post->blm;
				$nestedData['jenis_project'] = $post->jenis_project;
				$nestedData['tahun_glossary'] = $post->tahun_glossary;
				$nestedData['tahun_project'] = $post->tahun_project;
				$nestedData['awal_project'] = $post->awal_project;
				$nestedData['kode_ms'] = $post->kode_ms;
				$nestedData['kode_kec'] = $post->kode_kec;
				$nestedData['kode_kota'] = $post->kode_kota;
				$nestedData['kode_prop'] = $post->kode_prop;
				$nestedData['lokasi_blm'] = $post->lokasi_blm;
				$nestedData['Lokasi_kumuh'] = $post->Lokasi_kumuh;
				$nestedData['flag_kumuh'] = $post->flag_kumuh;
				$nestedData['flag_lokasi_ppmk'] = $post->flag_lokasi_ppmk;
				$nestedData['created_time'] = $post->created_time;
				$nestedData['created_by'] = $post->created_by;
				$nestedData['update_time'] = $post->update_time;
				$nestedData['update_by'] = $post->update_by;
				$nestedData['option'] = "&emsp;<a href='{$url_edit}' title='VIEW/EDIT' ><span class='fa fa-fw fa-edit'></span></a>
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
			$rowData = DB::select('select * from bkt_01010114_kel_faskel where kode='.$data['kode']);
			$data['kode_kmp_slum_prog'] = $rowData[0]->kode_kmp_slum_prog;
			$data['kode_faskel'] = $rowData[0]->kode_faskel;
			$data['kode_kel'] = $rowData[0]->kode_kel;
			$data['blm'] = $rowData[0]->blm;
			$data['jenis_project'] = $rowData[0]->jenis_project;
			$data['tahun_glossary'] = $rowData[0]->tahun_glossary;
			$data['tahun_project'] = $rowData[0]->tahun_project;
			$data['awal_project'] = $rowData[0]->awal_project;
			$data['kode_ms'] = $rowData[0]->kode_ms;
			$data['kode_kec'] = $rowData[0]->kode_kec;
			$data['kode_kota'] = $rowData[0]->kode_kota;
			$data['kode_prop'] = $rowData[0]->kode_prop;
			$data['lokasi_blm'] = $rowData[0]->lokasi_blm;
			$data['Lokasi_kumuh'] = $rowData[0]->Lokasi_kumuh;
			$data['flag_kumuh'] = $rowData[0]->flag_kumuh;
			$data['flag_lokasi_ppmk'] = $rowData[0]->flag_lokasi_ppmk;
			$data['created_time'] = $rowData[0]->created_time;
			$data['created_by'] = $rowData[0]->created_by;
			$data['updated_time'] = $rowData[0]->updated_time;
			$data['updated_by'] = $rowData[0]->updated_by;
		}else{
			$data['kode_kmp_slum_prog'] = null;
			$data['kode_faskel'] = null;
			$data['kode_kel'] = null;
			$data['blm'] = null;
			$data['jenis_project'] = null;
			$data['tahun_glossary'] = null;
			$data['tahun_project'] = null;
			$data['awal_project'] = null;
			$data['kode_ms'] = null;
			$data['kode_kec'] = null;
			$data['kode_kota'] = null;
			$data['kode_prop'] = null;
			$data['lokasi_blm'] = null;
			$data['Lokasi_kumuh'] = null;
			$data['flag_kumuh'] = null;
			$data['flag_lokasi_ppmk'] = null;
			$data['created_time'] = null;
			$data['created_by'] = null;
			$data['updated_time'] = null;
			$data['updated_by'] = null;
		}

		//get dropdown list from Database
		$kode_kmp_slum_program = DB::select('select kode from bkt_01010109_kmp_slum_prog');
		$data['kode_kmp_slum_program_list'] = $kode_kmp_slum_program;

		$kode_faskel = DB::select('select kode, nama from bkt_01010113_faskel');
		$data['kode_faskel_list'] = $kode_faskel;

		$kode_kel = DB::select('select kode, nama from bkt_01010104_kel');
		$data['kode_kel_list'] = $kode_kel;

		$kode_kec = DB::select('select kode, nama from bkt_01010103_kec');
		$data['kode_kec_list'] = $kode_kec;

		$kode_kota = DB::select('select kode, nama from bkt_01010102_kota');
		$data['kode_kota_list'] = $kode_kota;

		$kode_prop = DB::select('select kode, nama from bkt_01010101_prop');
		$data['kode_prop_list'] = $kode_prop;

		if (Auth::check()) {
			$user = Auth::user();
			$data['username'] = Auth::user()->name;
		}
		return view('MAIN/bk010114/create',$data);
	}

	public function post_create(Request $request)
	{
		date_default_timezone_set('Asia/Jakarta');
		if ($request->input('example-id-input')!=null){
			DB::table('bkt_01010114_kel_faskel')->where('kode', $request->input('example-id-input'))
			->update(['kode_kmp_slum_prog' => $request->input('example-kode_kmp_slum_prog-input'), 
				'kode_faskel' => $request->input('example-kode_faskel-input'), 
				'kode_kel' => $request->input('example-kode_kel-input'), 
				'blm' => $request->input('example-select-blm'), 
				'jenis_project' => $request->input('example-select-jenis_project'),
				'tahun_glossary' => $request->input('example-tahun_glossary-input'),
				'tahun_project' => $request->input('example-tahun_project-input'),
				'awal_project' => $request->input('example-awal_project-input'),
				'kode_ms' => $request->input('example-select-kode_ms'),
				'kode_kec' => $request->input('example-kode_kec-input'),
				'kode_kota' => $request->input('example-kode_kota-input'),
				'kode_prop' => $request->input('example-kode_prop-input'),
				'lokasi_blm' => $request->input('example-select-lokasi_blm'),
				'Lokasi_kumuh' => $request->input('example-select-Lokasi_kumuh'),
				'flag_kumuh' => $request->input('example-select-flag_kumuh'),
				'flag_lokasi_ppmk' => $request->input('example-select-flag_lokasi_ppmk'),
				'updated_time' => date('Y-m-d H:i:s'),
				'updated_by' => Auth::user()->id
				]);

		}else{
			DB::table('bkt_01010114_kel_faskel')->insert(
       			['kode_kmp_slum_prog' => $request->input('example-kode_kmp_slum_prog-input'), 
				'kode_faskel' => $request->input('example-kode_faskel-input'), 
				'kode_kel' => $request->input('example-kode_kel-input'), 
				'blm' => $request->input('example-select-blm'), 
				'jenis_project' => $request->input('example-select-jenis_project'),
				'tahun_glossary' => $request->input('example-tahun_glossary-input'),
				'tahun_project' => $request->input('example-tahun_project-input'),
				'awal_project' => $request->input('example-awal_project-input'),
				'kode_ms' => $request->input('example-select-kode_ms'),
				'kode_kec' => $request->input('example-kode_kec-input'),
				'kode_kota' => $request->input('example-kode_kota-input'),
				'kode_prop' => $request->input('example-kode_prop-input'),
				'lokasi_blm' => $request->input('example-select-lokasi_blm'),
				'Lokasi_kumuh' => $request->input('example-select-Lokasi_kumuh'),
				'flag_kumuh' => $request->input('example-select-flag_kumuh'),
				'flag_lokasi_ppmk' => $request->input('example-select-flag_lokasi_ppmk'),
				'created_by' => Auth::user()->id
       			]);
		}
	}

	public function delete(Request $request)
	{
		DB::table('bkt_01010114_kel_faskel')->where('kode', $request->input('kode'))->delete();
        return Redirect::to('/main/kel_faskel');
    }
}

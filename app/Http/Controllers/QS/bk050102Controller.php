<?php

namespace App\Http\Controllers\QS;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Redirect;

class bk050102Controller extends Controller
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
        $user = Auth::user();
        $akses= $user->menu()->where('kode_apps', 5)->get();
		if(count($akses) > 0){
			foreach ($akses as $item) {
				$data['menu'][$item->kode_menu] =  'a' ;
				if($item->kode_menu==151)
					$data['detil'][$item->kode_menu_detil]='a';
			}
			if(!empty($data['detil'])){
			    $data['username'] = $user->name;
				$this->log_aktivitas('View', 483);
				return view('QS/bk050102/index',$data);
			}
			else {
				return Redirect::to('/');
			}
		}else{
			return Redirect::to('/');
		}
    }

	public function Post(Request $request)
	{
		$columns = array(
			0 =>'id',
			1 =>'agenda',
			2 =>'parent',
			3 =>'kode_keg_kel',
			4 =>'no_urut',
			5 =>'nama_kegiatan',
			6 =>'tgl_mulai',
			7 =>'tgl_selesai',
			8 =>'nama_order'
		);
		$query='select a.id,a.kode_keg_kel,a.no_urut,a.tgl_mulai,a.tgl_selesai,case when a.status=1 then "aktif" else "tidak aktif" end status,b.nama agenda,c.nama_kegiatan parent ,
			case when ISNULL(f.nama_kegiatan) AND ISNULL(e.nama_kegiatan) AND ISNULL(d.nama_kegiatan)  AND c.nama_kegiatan is not null then concat("&nbsp;&nbsp;&nbsp;",a.nama_kegiatan)
						when ISNULL(f.nama_kegiatan) AND ISNULL(e.nama_kegiatan) AND d.nama_kegiatan is not null AND c.nama_kegiatan is not null then concat("&nbsp;&nbsp;&nbsp;","&nbsp;&nbsp;&nbsp;",a.nama_kegiatan)
						when  ISNULL(e.nama_kegiatan) AND e.nama_kegiatan is not null AND d.nama_kegiatan is not null AND c.nama_kegiatan is not null then concat("&nbsp;&nbsp;&nbsp;","&nbsp;&nbsp;&nbsp;","&nbsp;&nbsp;&nbsp;",a.nama_kegiatan)
						when  f.nama_kegiatan is not null AND e.nama_kegiatan is not null AND d.nama_kegiatan is not null AND c.nama_kegiatan is not null then concat("&nbsp;&nbsp;&nbsp;","&nbsp;&nbsp;&nbsp;","&nbsp;&nbsp;&nbsp;","&nbsp;&nbsp;&nbsp;",a.nama_kegiatan)
						else a.nama_kegiatan end nama_kegiatan,
			case when ISNULL(f.nama_kegiatan) AND ISNULL(e.nama_kegiatan) AND ISNULL(d.nama_kegiatan)  AND c.nama_kegiatan is not null then concat(c.nama_kegiatan,"->",a.nama_kegiatan)
						when ISNULL(f.nama_kegiatan) AND ISNULL(e.nama_kegiatan) AND d.nama_kegiatan is not null AND c.nama_kegiatan is not null then concat(d.nama_kegiatan,"->",c.nama_kegiatan,"->",a.nama_kegiatan)
						when  ISNULL(e.nama_kegiatan) AND e.nama_kegiatan is not null AND d.nama_kegiatan is not null AND c.nama_kegiatan is not null then concat(e.nama_kegiatan,"->",d.nama_kegiatan,"->",c.nama_kegiatan,"->",a.nama_kegiatan)
						when  f.nama_kegiatan is not null AND e.nama_kegiatan is not null AND d.nama_kegiatan is not null AND c.nama_kegiatan is not null then concat(f.nama_kegiatan,"->",e.nama_kegiatan,"->",d.nama_kegiatan,"->",c.nama_kegiatan,"->",a.nama_kegiatan)
						else a.nama_kegiatan end nama_order
			from bkt_05010102_kegiatan_kel a left join bkt_05010102_kegiatan_kel c on a.id_parent=c.id left join bkt_05010102_kegiatan_kel d on c.id_parent=d.id
			left join bkt_05010102_kegiatan_kel e on d.id_parent=e.id left join bkt_05010102_kegiatan_kel f on e.id_parent=f.id
			,bkt_05010101_agenda b where a.id_agenda=b.id and a.status !=2 ';
		$totalData = DB::select('select count(1) cnt from bkt_05010102_kegiatan_kel a ,bkt_05010101_agenda b where a.id_agenda=b.id and a.status !=2');
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
			$posts=DB::select($query. ' and a.nama_kegiatan like "%'.$search.'%"  order by '.$order.' '.$dir.' limit '.$start.','.$limit);
			$totalFiltered=DB::select('select count(1) cnt from ('.$query. ' and a.nama_kegiatan like "%'.$search.'%" ) a');
			$totalFiltered=$totalFiltered[0]->cnt;
		}

		$data = array();
		if(!empty($posts))
		{
			foreach ($posts as $post)
			{
				$edit =  $post->id;
				$url_edit="/qs/master/kegiatan_kelurahan/create?id=".$edit;
				$url_delete="/qs/master/kegiatan_kelurahan/delete?id=".$edit;
				$nestedData['id'] = $post->id;
				$nestedData['parent'] = $post->parent;
				$nestedData['kode_keg_kel'] = $post->kode_keg_kel;
				$nestedData['no_urut'] = $post->no_urut;
				$nestedData['nama_kegiatan'] = $post->nama_kegiatan;
				$nestedData['tgl_mulai'] = $post->tgl_mulai;
				$nestedData['tgl_selesai'] = $post->tgl_selesai;
				$nestedData['agenda'] = $post->agenda;
				$nestedData['status'] = $post->status;
				$user = Auth::user();
		        $akses= $user->menu()->where('kode_apps', 5)->get();
				if(count($akses) > 0){
					foreach ($akses as $item) {
						if($item->kode_menu==151)
							$detil[$item->kode_menu_detil]='a';
					}
				}

				$option = '';
				if(!empty($detil['485'])){
					$option .= "&emsp;<a href='{$url_edit}' title='VIEW/EDIT' ><span class='fa fa-fw fa-edit'></span></a>";
				}
				if(!empty($detil['486'])){
					$option .= "&emsp;<a href='#' onclick='delete_func(\"{$url_delete}\");'><span class='fa fa-fw fa-trash-o'></span></a>";
				}
				$nestedData['option'] = $option;
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
		$user = Auth::user();
        $akses= $user->menu()->where('kode_apps', 5)->get();
		if(count($akses) > 0){
			foreach ($akses as $item) {
				$data['menu'][$item->kode_menu] =  'a' ;
				if($item->kode_menu==151)
					$data['detil'][$item->kode_menu_detil]='a';
			}
			$data['username'] = $user->name;
			$data['id']=$request->input('id');
			$data['agenda_list'] = DB::select('select nama,id from bkt_05010101_agenda where status=1');
			$data['parent_list'] = DB::select('select nama_kegiatan,id from bkt_05010102_kegiatan_kel where status=1');
			if($data['id']!=null && !empty($data['detil']['485'])){
				$rowData = DB::select('select * from bkt_05010102_kegiatan_kel where id='.$data['id']);
				$data['id_agenda'] = $rowData[0]->id_agenda;
				$data['id_parent'] = $rowData[0]->id_parent;
				$data['kode_keg_kel'] = $rowData[0]->kode_keg_kel;
				$data['no_urut'] = $rowData[0]->no_urut;
				$data['nama_kegiatan'] = $rowData[0]->nama_kegiatan;
				$data['tgl_mulai'] = $rowData[0]->tgl_mulai;
				$data['tgl_selesai'] = $rowData[0]->tgl_selesai;
				$data['kode_glossary'] = $rowData[0]->kode_glossary;
				$data['flag_lok_peningkatan'] = $rowData[0]->flag_lok_peningkatan;
				$data['flag_lok_pencegahan'] = $rowData[0]->flag_lok_pencegahan;
				$data['flag_lok_ppmk_baru'] = $rowData[0]->flag_lok_ppmk_baru;
				$data['flag_lok_bdi_plbk'] = $rowData[0]->flag_lok_bdi_plbk;
				$data['status'] = $rowData[0]->status;
				$data['created_time'] = $rowData[0]->created_time;
				$data['created_by'] = $rowData[0]->created_by;
				$data['updated_time'] = $rowData[0]->updated_time;
				$data['updated_by'] = $rowData[0]->updated_by;
				return view('QS/bk050102/create',$data);
			}else if($data['id']==null && !empty($data['detil']['484'])){
				$data['id_agenda'] = null;
				$data['id_parent'] = null;
				$data['kode_keg_kel'] = null;
				$data['no_urut'] = null;
				$data['nama_kegiatan'] = null;
				$data['tgl_mulai'] = null;
				$data['tgl_selesai'] = null;
				$data['kode_glossary'] = null;
				$data['flag_lok_peningkatan'] = null;
				$data['flag_lok_pencegahan'] = null;
				$data['flag_lok_ppmk_baru'] = null;
				$data['flag_lok_bdi_plbk'] = null;
				$data['status'] = null;
				$data['created_time'] = null;
				$data['created_by'] = null;
				$data['updated_time'] = null;
				$data['updated_by'] = null;
				return view('QS/bk050102/create',$data);
			}else {
				return Redirect::to('/');
			}
		}else{
			return Redirect::to('/');
		}
	}

	public function post_create(Request $request)
	{
		date_default_timezone_set('Asia/Jakarta');
		if ($request->input('id')!=null){
			DB::table('bkt_05010102_kegiatan_kel')->where('id', $request->input('id'))
			->update(['id_agenda' => $request->input('id_agenda-input'),
				'id_parent' => $request->input('id_parent-input'),
				'kode_keg_kel' => $request->input('kode_keg_kel-input'),
				'no_urut' => $request->input('no_urut-input'),
				'nama_kegiatan' => $request->input('nama_kegiatan-input'),
				'tgl_mulai' => $request->input('tgl_mulai-input'),
				'tgl_selesai' => $request->input('tgl_selesai-input'),
				'kode_glossary' => $request->input('kode_glossary-input'),
				'flag_lok_peningkatan' => $request->input('flag_lok_peningkatan-input')=="0"||$request->input('flag_lok_peningkatan-input')=="1"?(int)$request->input('flag_lok_peningkatan-input'):null,
				'flag_lok_pencegahan' => $request->input('flag_lok_pencegahan-input')=="0"||$request->input('flag_lok_pencegahan-input')=="1"?(int)$request->input('flag_lok_pencegahan-input'):null,
				'flag_lok_ppmk_baru' => $request->input('flag_lok_ppmk_baru-input')=="0"||$request->input('flag_lok_ppmk_baru-input')=="1"?(int)$request->input('flag_lok_ppmk_baru-input'):null,
				'flag_lok_bdi_plbk' => $request->input('flag_lok_bdi_plbk-input')=="0"||$request->input('flag_lok_bdi_plbk-input')=="1"?(int)$request->input('flag_lok_bdi_plbk-input'):null,
				'status' => $request->input('status-input'),
				'updated_time' => date('Y-m-d H:i:s'),
				'updated_by' => Auth::user()->id
				]);
			$this->log_aktivitas('Update', 485);

		}else{
			DB::table('bkt_05010102_kegiatan_kel')->insert(
       			['id_agenda' => $request->input('id_agenda-input'),
				'id_parent' => $request->input('id_parent-input'),
				'kode_keg_kel' => $request->input('kode_keg_kel-input'),
				'no_urut' => $request->input('no_urut-input'),
				'nama_kegiatan' => $request->input('nama_kegiatan-input'),
				'tgl_mulai' => $request->input('tgl_mulai-input'),
				'tgl_selesai' => $request->input('tgl_selesai-input'),
				'kode_glossary' => $request->input('kode_glossary-input'),
				'flag_lok_peningkatan' => $request->input('flag_lok_peningkatan-input')=="0"||$request->input('flag_lok_peningkatan-input')=="1"?(int)$request->input('flag_lok_peningkatan-input'):null,
				'flag_lok_pencegahan' => $request->input('flag_lok_pencegahan-input')=="0"||$request->input('flag_lok_pencegahan-input')=="1"?(int)$request->input('flag_lok_pencegahan-input'):null,
				'flag_lok_ppmk_baru' => $request->input('flag_lok_ppmk_baru-input')=="0"||$request->input('flag_lok_ppmk_baru-input')=="1"?(int)$request->input('flag_lok_ppmk_baru-input'):null,
				'flag_lok_bdi_plbk' => $request->input('flag_lok_bdi_plbk-input')=="0"||$request->input('flag_lok_bdi_plbk-input')=="1"?(int)$request->input('flag_lok_bdi_plbk-input'):null,
				'status' => $request->input('status-input'),
				'created_by' => Auth::user()->id
       			]);
			$this->log_aktivitas('Create', 484);
		}
	}

	public function delete(Request $request)
	{
		DB::table('bkt_05010102_kegiatan_kel')->where('id', $request->input('id'))->update(['status' => 2]);
        $this->log_aktivitas('Delete', 486);
        return Redirect::to('/qs/master/kegiatan_kelurahan');
    }

    public function log_aktivitas($aktifitas, $detil)
    {
    	DB::table('bkt_02030201_log_aktivitas')->insert([
			'kode_user' => Auth::user()->id,
			'kode_apps' => 5,
			'kode_modul' => 10,
			'kode_menu' => 151,
			'kode_menu_detil' => $detil,
			'aktifitas' => $aktifitas,
			'deskripsi' => $aktifitas
		]);
    }
}

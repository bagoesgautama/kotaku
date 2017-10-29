<?php

namespace App\Http\Controllers\MAIN;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Redirect;

class bk010503Controller extends Controller
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
        $user = Auth::user();
        $akses= $user->menu()->where('kode_apps', 1)->get();
		if(count($akses) > 0){
			foreach ($akses as $item) {
				$data['menu'][$item->kode_menu] =  'a' ;
				if($item->kode_menu==129)
					$data['detil'][$item->kode_menu_detil]='a';
			}
			if(!empty($data['detil'])){
			    $data['username'] = $user->name;

				$this->log_aktivitas('View', 404);
				return view('MAIN/bk010503/index',$data);
			}
			else {
				return Redirect::to('/');
			}
		}else{
			return Redirect::to('/');
		}
    }

    public function select(Request $request)
	{
		if(!empty($request->input('kmw'))){
			$kota = DB::select('select b.kode, b.nama from bkt_01010110_kmw a, bkt_01010102_kota b where a.kode_prop=b.kode_prop and a.kode='.$request->input('kmw'));
			echo json_encode($kota);
		}
		if(!empty($request->input('kota_korkot'))){
			$korkot = DB::select('select b.kode, b.nama from bkt_01010112_kota_korkot a, bkt_01010111_korkot b where a.kode_korkot=b.kode and a.kode_kota='.$request->input('kota_korkot'));
			echo json_encode($korkot);
		}
		if(!empty($request->input('kota_kec'))){
			$kec = DB::select('select kode, nama from bkt_01010103_kec where kode_kota='.$request->input('kota_kec'));
			echo json_encode($kec);
		}
		if(!empty($request->input('kec_kel'))){
			$kel = DB::select('select kode, nama from bkt_01010104_kel where kode_kec='.$request->input('kec_kel'));
			echo json_encode($kel);
		}
		if(!empty($request->input('kel_faskel'))){
			$faskel = DB::select('select b.kode, b.nama from bkt_01010114_kel_faskel a, bkt_01010113_faskel b where a.kode_faskel=b.kode and a.kode_kel='.$request->input('kel_faskel'));
			echo json_encode($faskel);
		}
		if(!empty($request->input('kota_bkm')) && !empty($request->input('kec_bkm')) && !empty($request->input('kel_bkm'))){
			$bkm = DB::select('select a.id, a.nama from bkt_01010125_bkm a, bkt_01010102_kota b, bkt_01010103_kec c, bkt_01010104_kel d where b.kode=a.kode_kota and c.kode=a.kode_kec and d.kode=a.kode_kel and a.kode_kota='.$request->input('kota_bkm').' and a.kode_kec='.$request->input('kec_bkm').' and a.kode_kel='.$request->input('kel_bkm'));
			echo json_encode($bkm);
		}
	}

	public function Post(Request $request)
	{
		$columns = array(
			0 =>'kode',
			1 =>'tahun',
			2 =>'kode_kota',
			3 =>'kode_kec',
			4 =>'kode_kel',
			5 =>'kode_bkm',
			6 =>'status',
			7 =>'created_time'
		);
		$query='
			select * from (select 
				a.*,
				a.tahun as tahun_stat_bkm,
				a.kode as kode_stat_bkm,
				case when a.status=0 then "Awal" when a.status=1 then "Berdaya" when a.status=2 then "Mandiri" when a.status=3 then "Menuju Madani" end status_convert,
				b.nama nama_kota,
				c.nama nama_korkot,
				d.nama nama_kmw,
				e.nama nama_kec,
				f.nama nama_kel,
				g.nama nama_faskel,
				h.nama nama_bkm
			from kotaku.bkt_01050203_status_bkm a
				left join kotaku.bkt_01010102_kota b on b.kode=a.kode_kota
				left join kotaku.bkt_01010111_korkot c on c.kode=a.kode_korkot
				left join kotaku.bkt_01010110_kmw d on d.kode=a.kode_kmw
				left join kotaku.bkt_01010103_kec e on e.kode=a.kode_kec
				left join kotaku.bkt_01010104_kel f on f.kode=a.kode_kel
				left join kotaku.bkt_01010113_faskel g on g.kode=a.kode_faskel
				left join kotaku.bkt_01010125_bkm h on h.id=a.kode_bkm) b';
		$totalData = DB::select('select count(1) cnt from bkt_01050203_status_bkm a
				left join bkt_01010102_kota b on b.kode=a.kode_kota
				left join bkt_01010111_korkot c on c.kode=a.kode_korkot
				left join bkt_01010110_kmw d on d.kode=a.kode_kmw
				left join bkt_01010103_kec e on e.kode=a.kode_kec
				left join bkt_01010104_kel f on f.kode=a.kode_kel
				left join bkt_01010113_faskel g on g.kode=a.kode_faskel
				left join bkt_01010125_bkm h on h.id=a.kode_bkm');
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
			$posts=DB::select($query. ' where (
				b.kode_stat_bkm like "%'.$search.'%" or 
				b.tahun_stat_bkm like "%'.$search.'%" or 
				b.nama_kota like "%'.$search.'%" or 
				b.nama_kec like "%'.$search.'%" or 
				b.nama_kel like "%'.$search.'%" or 
				b.nama_bkm like "%'.$search.'%" or
				b.status_convert like "%'.$search.'%") order by '.$order.' '.$dir.' limit '.$start.','.$limit);
			$totalFiltered=DB::select('select count(1) cnt from ('.$query. ' where (
				b.kode_stat_bkm like "%'.$search.'%" or 
				b.tahun_stat_bkm like "%'.$search.'%" or 
				b.nama_kota like "%'.$search.'%" or 
				b.nama_kec like "%'.$search.'%" or 
				b.nama_kel like "%'.$search.'%" or 
				b.nama_bkm like "%'.$search.'%" or
				b.status_convert like "%'.$search.'%")) a');
			$totalFiltered=$totalFiltered[0]->cnt;
		}

		$data = array();
		if(!empty($posts))
		{
			foreach ($posts as $post)
			{
				$show =  $post->kode;
				$edit =  $post->kode;
				$delete = $post->kode;
				// $status = null;

				// if($post->status == 0){
				// 	$status = 'Awal';
				// }elseif($post->status == 1){
				// 	$status = 'Berdaya';
				// }elseif($post->status == 2){
				// 	$status = 'Mandiri';
				// }elseif($post->status == 3){
				// 	$status = 'Menuju Madani';
				// }

				$url_edit=url('/')."/main/keberlanjutan/kelurahan/status_kemandirian/create?kode=".$edit;
				$url_delete=url('/')."/main/keberlanjutan/kelurahan/status_kemandirian/delete?kode=".$delete;
				$nestedData['kode'] = $post->kode;
				$nestedData['tahun'] = $post->tahun;
				$nestedData['kode_kota'] = $post->nama_kota;
				// $nestedData['kode_korkot'] = $post->kode_korkot;
				$nestedData['kode_kec'] = $post->nama_kec;
				$nestedData['kode_kel'] = $post->nama_kel;
				// $nestedData['kode_kmw'] = $post->kode_kmw;
				// $nestedData['kode_faskel'] = $post->kode_faskel;
				$nestedData['kode_bkm'] = $post->nama_bkm;
				$nestedData['status'] = $post->status_convert;
				$nestedData['created_time'] = $post->created_time;

				$user = Auth::user();
		        $akses= $user->menu()->where('kode_apps', 1)->get();
				if(count($akses) > 0){
					foreach ($akses as $item) {
						if($item->kode_menu==129)
							$detil[$item->kode_menu_detil]='a';
					}
				}

				$option = '';
				if(!empty($detil['406'])){
					$option .= "&emsp;<a href='{$url_edit}' title='EDIT' ><span class='fa fa-fw fa-edit'></span></a>";
				}
				if(!empty($detil['407'])){
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
        $akses= $user->menu()->where('kode_apps', 1)->get();
		if(count($akses) > 0){
			foreach ($akses as $item) {
				$data['menu'][$item->kode_menu] =  'a' ;
				if($item->kode_menu==129)
					$data['detil'][$item->kode_menu_detil]='a';
			}
			$data['username'] = $user->name;
			$data['kode']=$request->input('kode');
			if($data['kode']!=null  && !empty($data['detil']['406'])){
				$rowData = DB::select('select * from bkt_01050203_status_bkm where kode='.$data['kode']);
				$data['tahun'] = $rowData[0]->tahun;
				$data['kode_kota'] = $rowData[0]->kode_kota;
				$data['kode_korkot'] = $rowData[0]->kode_korkot;
				$data['kode_kmw'] = $rowData[0]->kode_kmw;
				$data['kode_kec'] = $rowData[0]->kode_kec;
				$data['kode_kel'] = $rowData[0]->kode_kel;
				$data['kode_faskel'] = $rowData[0]->kode_faskel;
				$data['kode_bkm'] = $rowData[0]->kode_bkm;
				$data['status'] = $rowData[0]->status;
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
				$data['kode_kmw_list'] = DB::select('select * from bkt_01010110_kmw');
				if(!empty($rowData[0]->kode_kmw))
					$data['kode_kota_list']=DB::select('select b.kode, b.nama from bkt_01010110_kmw a, bkt_01010102_kota b where a.kode_prop=b.kode_prop and a.kode='.$rowData[0]->kode_kmw);
				if(!empty($rowData[0]->kode_kota))
					$data['kode_korkot_list']=DB::select('select b.kode, b.nama from bkt_01010112_kota_korkot a, bkt_01010111_korkot b where a.kode_korkot=b.kode and a.kode_kota='.$rowData[0]->kode_kota);
				if(!empty($rowData[0]->kode_kota))
					$data['kode_kec_list']=DB::select('select kode, nama from bkt_01010103_kec where kode_kota='.$rowData[0]->kode_kota);
				if(!empty($rowData[0]->kode_kec))
					$data['kode_kel_list']=DB::select('select kode, nama from bkt_01010104_kel where kode_kec='.$rowData[0]->kode_kec);
				if(!empty($rowData[0]->kode_kel))
					$data['kode_faskel_list']=DB::select('select b.kode, b.nama from bkt_01010114_kel_faskel a, bkt_01010113_faskel b where a.kode_faskel=b.kode and a.kode_kel='.$rowData[0]->kode_kel);
				if(!empty($rowData[0]->kode_kota) && !empty($rowData[0]->kode_kec) && !empty($rowData[0]->kode_kel))
					$data['kode_bkm_list']=DB::select('select a.id, a.nama from bkt_01010125_bkm a, bkt_01010102_kota b, bkt_01010103_kec c, bkt_01010104_kel d where a.kode_kota='.$rowData[0]->kode_kota.' and a.kode_kec='.$rowData[0]->kode_kec.' and a.kode_kel='.$rowData[0]->kode_kel);
				$data['kode_user_list'] = DB::select('select * from bkt_02010111_user');
				return view('MAIN/bk010503/create',$data);
			}else if ($data['kode']==null  && !empty($data['detil']['405'])){
				$data['tahun'] = null;
				$data['kode_kota'] = null;
				$data['kode_korkot'] = null;
				$data['kode_kmw'] = null;
				$data['kode_kec'] = null;
				$data['kode_kel'] = null;
				$data['kode_faskel'] = null;
				$data['kode_bkm'] = null;
				$data['status'] = null;
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
				$data['kode_kota_list'] = null;
				$data['kode_kec_list'] = null;
				$data['kode_kmw_list'] = DB::select('select * from bkt_01010110_kmw');
				$data['kode_korkot_list'] = null;
				$data['kode_faskel_list'] = null;
				$data['kode_kel_list'] = null;
				$data['kode_bkm_list'] = null;
				$data['kode_user_list'] = DB::select('select * from bkt_02010111_user');
				return view('MAIN/bk010503/create',$data);
			}else{
				return Redirect::to('/');
			}
		}else{
			return Redirect::to('/');
		}
	}

	public function post_create(Request $request)
	{
		if ($request->input('kode')!=null){
			date_default_timezone_set('Asia/Jakarta');
			DB::table('bkt_01050203_status_bkm')->where('kode', $request->input('kode'))
			->update([
				'tahun' => $request->input('tahun-input'),
				'kode_kota' => $request->input('kode-kota-input'),
				'kode_korkot' => $request->input('kode-korkot-input'),
				'kode_kmw' => $request->input('kode-kmw-input'),
				'kode_kec' => $request->input('kode-kec-input'),
				'kode_kel' => $request->input('kode-kel-input'),
				'kode_faskel' => $request->input('kode-faskel-input'),
				'kode_bkm' => $request->input('kode-bkm-input'),
				'status' => $request->input('status'),
				// 'diser_tgl' => $this->date_conversion($request->input('tgl-diser-input')),
				// 'diser_oleh' => $request->input('diser-oleh-input'),
				// 'diket_tgl' => $this->date_conversion($request->input('tgl-diket-input')),
				// 'diket_oleh' => $request->input('diket-oleh-input'),
				// 'diver_tgl' => $this->date_conversion($request->input('tgl-diver-input')),
				// 'diver_oleh' => $request->input('diver-oleh-input'),
				'updated_by' => Auth::user()->id,
				'updated_time' => date('Y-m-d H:i:s')
				]);

			$this->log_aktivitas('Update', 406);

		}else{
			DB::table('bkt_01050203_status_bkm')->insert([
				'tahun' => $request->input('tahun-input'),
				'kode_kota' => $request->input('kode-kota-input'),
				'kode_korkot' => $request->input('kode-korkot-input'),
				'kode_kmw' => $request->input('kode-kmw-input'),
				'kode_kec' => $request->input('kode-kec-input'),
				'kode_kel' => $request->input('kode-kel-input'),
				'kode_faskel' => $request->input('kode-faskel-input'),
				'kode_bkm' => $request->input('kode-bkm-input'),
				'status' => $request->input('status'),
				// 'diser_tgl' => $this->date_conversion($request->input('tgl-diser-input')),
				// 'diser_oleh' => $request->input('diser-oleh-input'),
				// 'diket_tgl' => $this->date_conversion($request->input('tgl-diket-input')),
				// 'diket_oleh' => $request->input('diket-oleh-input'),
				// 'diver_tgl' => $this->date_conversion($request->input('tgl-diver-input')),
				// 'diver_oleh' => $request->input('diver-oleh-input'),
				'created_by' => Auth::user()->id
       			]);

			$this->log_aktivitas('Create', 405);
		}
	}

	public function date_conversion($date)
	{
        $date_convert = date('Y-m-d', strtotime($date));
        return $date_convert;
	}

	public function delete(Request $request)
	{
		DB::table('bkt_01050203_status_bkm')->where('kode', $request->input('kode'))->delete();
		$this->log_aktivitas('Delete', 407);
        return Redirect::to('/main/keberlanjutan/kelurahan/status_kemandirian');
    }

    public function log_aktivitas($aktifitas, $detil)
    {
    	DB::table('bkt_02030201_log_aktivitas')->insert([
				'kode_user' => Auth::user()->id,
				'kode_apps' => 1,
				'kode_modul' => 8,
				'kode_menu' => 129,
				'kode_menu_detil' => $detil,
				'aktifitas' => $aktifitas,
				'deskripsi' => $aktifitas
       			]);
    }
}

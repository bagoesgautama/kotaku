<?php

namespace App\Http\Controllers\MAIN;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Redirect;

class bk010505Controller extends Controller
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
				if($item->kode_menu==131)
					$data['detil'][$item->kode_menu_detil]='a';
			}
			if(!empty($data['detil'])){
			    $data['username'] = $user->name;

				$this->log_aktivitas('View', 412);
				return view('MAIN/bk010505/index',$data);
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
			0 =>'kode',
			1 =>'tahun',
			2 =>'kode_prop',
			3 =>'kode_kota',
			4 =>'kode_kec',
			5 =>'kode_kel',
			6 =>'flag_audit',
			7 =>'hasil_audit',
			8 =>'created_time'
		);
		$query='
			select * from (select 
				a.*,
				a.kode kode_audit,
				a.tahun tahun_audit,
				case when a.flag_audit=0 then "Belum Selesai" when a.flag_audit=1 then "Sudah Selesai" end flag_audit_convert, 
				case when a.hasil_audit="UO" then "Wajar Tanpa Pengecualian (Unqualified Opinion/UO)" when a.hasil_audit="QO" then "Wajar Dengan Pengecualian (Qualified Opinion)" when a.hasil_audit="AO" then "Tidak Wajar (Adverse Opinion/AO)" when a.hasil_audit="DO" then "Tidak Memberikan Pendapat (Disclaimer Opinion/DO)" end hasil_audit_convert,
				b.nama nama_prop,
				c.nama nama_kota,
				d.nama nama_korkot,
				e.nama nama_kmw,
				f.nama nama_kec,
				g.nama nama_kel,
				h.nama nama_faskel
			from bkt_01050202_audit a 
				left join bkt_01010101_prop b on b.kode=a.kode_prop
				left join bkt_01010102_kota c on c.kode=a.kode_kota
				left join bkt_01010111_korkot d on d.kode=a.kode_korkot
				left join bkt_01010110_kmw e on e.kode=a.kode_kmw
				left join bkt_01010103_kec f on f.kode=a.kode_kec
				left join bkt_01010104_kel g on g.kode=a.kode_kel
				left join bkt_01010113_faskel h on h.kode=a.kode_faskel) b';
		$totalData = DB::select('select count(1) cnt from bkt_01050202_audit a 
				left join bkt_01010101_prop b on b.kode=a.kode_prop
				left join bkt_01010102_kota c on c.kode=a.kode_kota
				left join bkt_01010111_korkot d on d.kode=a.kode_korkot
				left join bkt_01010110_kmw e on e.kode=a.kode_kmw
				left join bkt_01010103_kec f on f.kode=a.kode_kec
				left join bkt_01010104_kel g on g.kode=a.kode_kel
				left join bkt_01010113_faskel h on h.kode=a.kode_faskel');
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
				b.kode_audit like "%'.$search.'%" or 
				b.flag_audit_convert like "%'.$search.'%" or 
				b.hasil_audit_convert like "%'.$search.'%" or 
				b.nama_prop like "%'.$search.'%" or 
				b.nama_kota like "%'.$search.'%" or 
				b.nama_kec like "%'.$search.'%" or 
				b.nama_kel like "%'.$search.'%" or 
				b.tahun_audit like "%'.$search.'%") order by '.$order.' '.$dir.' limit '.$start.','.$limit);
			$totalFiltered=DB::select('select count(1) cnt from ('.$query. ' where (
				b.kode_audit like "%'.$search.'%" or 
				b.flag_audit_convert like "%'.$search.'%" or 
				b.hasil_audit_convert like "%'.$search.'%" or 
				b.nama_prop like "%'.$search.'%" or 
				b.nama_kota like "%'.$search.'%" or 
				b.nama_kec like "%'.$search.'%" or 
				b.nama_kel like "%'.$search.'%" or 
				b.tahun_audit like "%'.$search.'%")) a');
			$totalFiltered = $totalFiltered[0]->cnt;
		}

		$data = array();
		if(!empty($posts))
		{
			foreach ($posts as $post)
			{
				$show =  $post->kode;
				$edit =  $post->kode;
				$delete = $post->kode;

				$url_edit=url('/')."/main/keberlanjutan/kelurahan/audit/create?kode=".$edit;
				$url_delete=url('/')."/main/keberlanjutan/kelurahan/audit/delete?kode=".$delete;
				$nestedData['kode'] = $post->kode_audit;
				$nestedData['tahun'] = $post->tahun_audit;
				$nestedData['kode_prop'] = $post->nama_prop;
				$nestedData['kode_kota'] = $post->nama_kota;
				$nestedData['kode_kec'] = $post->nama_kec;
				$nestedData['kode_kel'] = $post->nama_kel;
				$nestedData['flag_audit'] = $post->flag_audit_convert;
				$nestedData['hasil_audit'] = $post->hasil_audit_convert;
				$nestedData['created_time'] = $post->created_time;

				$user = Auth::user();
		        $akses= $user->menu()->where('kode_apps', 1)->get();
				if(count($akses) > 0){
					foreach ($akses as $item) {
						if($item->kode_menu==131)
							$detil[$item->kode_menu_detil]='a';
					}
				}

				$option = '';
				if(!empty($detil['414'])){
					$option .= "&emsp;<a href='{$url_edit}' title='EDIT' ><span class='fa fa-fw fa-edit'></span></a>";
				}
				if(!empty($detil['415'])){
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

	public function select(Request $request)
	{
		if(!empty($request->input('prop'))){
			$kmw = DB::select('select b.kode, b.nama from bkt_01010101_prop a, bkt_01010110_kmw b where b.kode_prop=a.kode and b.kode_prop='.$request->input('prop'));
			echo json_encode($kmw);
		}
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
	}

	public function create(Request $request)
	{
		$user = Auth::user();
        $akses= $user->menu()->where('kode_apps', 1)->get();
		if(count($akses) > 0){
			foreach ($akses as $item) {
				$data['menu'][$item->kode_menu] =  'a' ;
				if($item->kode_menu==131)
					$data['detil'][$item->kode_menu_detil]='a';
			}
			$data['username'] = $user->name;
			$data['kode']=$request->input('kode');
			if($data['kode']!=null  && !empty($data['detil']['414'])){
				$rowData = DB::select('select * from bkt_01050202_audit where kode='.$data['kode']);
				$data['tahun'] = $rowData[0]->tahun;
				$data['kode_prop'] = $rowData[0]->kode_prop;
				$data['kode_kota'] = $rowData[0]->kode_kota;
				$data['kode_korkot'] = $rowData[0]->kode_korkot;
				$data['kode_kec'] = $rowData[0]->kode_kec;
				$data['kode_kmw'] = $rowData[0]->kode_kmw;
				$data['kode_kel'] = $rowData[0]->kode_kel;
				$data['kode_faskel'] = $rowData[0]->kode_faskel;
				$data['flag_audit'] = $rowData[0]->flag_audit;
				$data['hasil_audit'] = $rowData[0]->hasil_audit;
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
				$data['kode_prop_list'] = DB::select('select * from bkt_01010101_prop where status=1');
				if(!empty($rowData[0]->kode_kmw))
					$data['kode_kota_list']=DB::select('select b.kode, b.nama from bkt_01010110_kmw a, bkt_01010102_kota b where a.kode_prop=b.kode_prop and a.kode='.$rowData[0]->kode_kmw);
				if(!empty($rowData[0]->kode_kota))
					$data['kode_kec_list']=DB::select('select kode, nama from bkt_01010103_kec where kode_kota='.$rowData[0]->kode_kota);
				if(!empty($rowData[0]->kode_prop))
					$data['kode_kmw_list']=DB::select('select a.kode, a.nama from bkt_01010101_prop b, bkt_01010110_kmw a where a.kode_prop=b.kode and a.kode_prop='.$rowData[0]->kode_prop);
				if(!empty($rowData[0]->kode_kota))
					$data['kode_korkot_list']=DB::select('select b.kode, b.nama from bkt_01010112_kota_korkot a, bkt_01010111_korkot b where a.kode_korkot=b.kode and a.kode_kota='.$rowData[0]->kode_kota);
				if(!empty($rowData[0]->kode_kel))
					$data['kode_faskel_list']=DB::select('select b.kode, b.nama from bkt_01010114_kel_faskel a, bkt_01010113_faskel b where a.kode_faskel=b.kode and a.kode_kel='.$rowData[0]->kode_kel);
				if(!empty($rowData[0]->kode_kec))
					$data['kode_kel_list']=DB::select('select kode, nama from bkt_01010104_kel where kode_kec='.$rowData[0]->kode_kec);
				$data['kode_user_list'] = DB::select('select * from bkt_02010111_user');
				return view('MAIN/bk010505/create',$data);
			}else if ($data['kode']==null  && !empty($data['detil']['413'])){
				$data['tahun'] = null;
				$data['kode_prop'] = null;
				$data['kode_kota'] = null;
				$data['kode_korkot'] = null;
				$data['kode_kec'] = null;
				$data['kode_kmw'] = null;
				$data['kode_kel'] = null;
				$data['kode_faskel'] = null;
				$data['flag_audit'] = null;
				$data['hasil_audit'] = null;
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
				$data['kode_prop_list'] = DB::select('select * from bkt_01010101_prop where status=1');
				$data['kode_kota_list'] = null;
				$data['kode_kec_list'] = null;
				$data['kode_kmw_list'] = null;
				$data['kode_korkot_list'] = null;
				$data['kode_faskel_list'] = null;
				$data['kode_kel_list'] = null;
				$data['kode_user_list'] = DB::select('select * from bkt_02010111_user');
				return view('MAIN/bk010505/create',$data);
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
			DB::table('bkt_01050202_audit')->where('kode', $request->input('kode'))
			->update([
				'tahun' => $request->input('tahun-input'),
				'kode_prop' => $request->input('kode-prop-input'),
				'kode_kota' => $request->input('kode-kota-input'),
				'kode_kec' => $request->input('kode-kec-input'),
				'kode_kel' => $request->input('kode-kel-input'),
				'kode_kmw' => $request->input('kode-kmw-input'),
				'kode_korkot' => $request->input('kode-korkot-input'),
				'kode_faskel' => $request->input('kode-faskel-input'),
				'flag_audit' => intval($request->input('flag_audit')),
				'hasil_audit' => $request->input('hasil_audit'),
				// 'diser_tgl' => $this->date_conversion($request->input('tgl-diser-input')),
				// 'diser_oleh' => $request->input('diser-oleh-input'),
				// 'diket_tgl' => $this->date_conversion($request->input('tgl-diket-input')),
				// 'diket_oleh' => $request->input('diket-oleh-input'),
				// 'diver_tgl' => $this->date_conversion($request->input('tgl-diver-input')),
				// 'diver_oleh' => $request->input('diver-oleh-input'),
				'updated_by' => Auth::user()->id,
				'updated_time' => date('Y-m-d H:i:s')
				]);

			$this->log_aktivitas('Update', 414);

		}else{
			DB::table('bkt_01050202_audit')->insert([
				'tahun' => $request->input('tahun-input'),
				'kode_prop' => $request->input('kode-prop-input'),
				'kode_kota' => $request->input('kode-kota-input'),
				'kode_kec' => $request->input('kode-kec-input'),
				'kode_kel' => $request->input('kode-kel-input'),
				'kode_kmw' => $request->input('kode-kmw-input'),
				'kode_korkot' => $request->input('kode-korkot-input'),
				'kode_faskel' => $request->input('kode-faskel-input'),
				'flag_audit' => intval($request->input('flag_audit')),
				'hasil_audit' => $request->input('hasil_audit'),
				// 'diser_tgl' => $this->date_conversion($request->input('tgl-diser-input')),
				// 'diser_oleh' => $request->input('diser-oleh-input'),
				// 'diket_tgl' => $this->date_conversion($request->input('tgl-diket-input')),
				// 'diket_oleh' => $request->input('diket-oleh-input'),
				// 'diver_tgl' => $this->date_conversion($request->input('tgl-diver-input')),
				// 'diver_oleh' => $request->input('diver-oleh-input'),
				'created_by' => Auth::user()->id
       			]);

			$this->log_aktivitas('Create', 413);
		}
	}

	public function date_conversion($date)
	{
        $date_convert = date('Y-m-d', strtotime($date));
        return $date_convert;
	}

	public function delete(Request $request)
	{
		DB::table('bkt_01050202_audit')->where('kode', $request->input('kode'))->delete();
		$this->log_aktivitas('Delete', 411);
        return Redirect::to('/main/keberlanjutan/kelurahan/audit');
    }

    public function log_aktivitas($aktifitas, $detil)
    {
    	DB::table('bkt_02030201_log_aktivitas')->insert([
				'kode_user' => Auth::user()->id,
				'kode_apps' => 1,
				'kode_modul' => 8,
				'kode_menu' => 131,
				'kode_menu_detil' => $detil,
				'aktifitas' => $aktifitas,
				'deskripsi' => $aktifitas
       			]);
    }
}

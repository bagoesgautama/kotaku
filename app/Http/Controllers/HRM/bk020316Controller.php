<?php

namespace App\Http\Controllers\HRM;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Redirect;

class bk020316Controller extends Controller
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
        $akses= $user->menu()->where('kode_apps', 2)->get();
		if(count($akses) > 0){
			foreach ($akses as $item) {
				$data['menu'][$item->kode_menu] =  'a' ;
				if($item->kode_menu==182)
					$data['detil'][$item->kode_menu_detil]='a';
			}
			if(!empty($data['detil'])){
			    $data['username'] = $user->name;
				$data['totalData'] = DB::select('select b.kode modul_id,b.nama modul,c.kode apps_id,c.nama apps
					from bkt_02010104_modul b,bkt_02010103_apps c
					where b.kode_apps=c.kode');
				$data['role'] = DB::select('select * from bkt_02010102_role where status=1');

				$this->log_aktivitas('View', 570);
				return view('HRM/bk020316/index',$data);
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
		$user = Auth::user();
		$columns = array(
			0 => 'user_name',
			1 => 'nama_depan',
			2 => 'nama_belakang',
			3 => 'kode_jenis_kelamin',
			4 => 'jenis_registrasi',
			5 => 'status_registrasi',
			6 => 'created_time',
		);
		if($user->kode_role==1){
			$query='
				select * from (select 
					*,
					user_name user_name_real,
					nama_depan nama_depan_real,
					nama_belakang nama_belakang_real, 
					case
						when kode_jenis_kelamin = "P" then "Pria"
						when kode_jenis_kelamin = "W" then "Wanita"
					end jenis_kel,
					case
						when jenis_registrasi = "0" then "Mandiri"
						when jenis_registrasi = "1" then "Manual"
					end jenis_reg,
					case
						when status_registrasi = "0" then "Belum Diverifikasi"
					end status_reg
				from bkt_02020201_registrasi
				where status_registrasi=0
				) b ';
			$totalData = DB::select('select count(1) cnt from bkt_02020201_registrasi
									where status_registrasi=0 ');
		}else{
			$query='select u.*
					from bkt_02020201_registrasi u,
					    (select kode_level from bkt_02010111_user where user_name = '.$user->user_name.') r
					where (u.kode_role, 
							case when r.kode_level = 0 then "x" else u.kode_kmp end, 
							case when r.kode_level in (0,1) then "x" else u.kode_kmw end, 
							case when r.kode_level in (0,1) then "x" else u.wk_kd_prop end,
							case when r.kode_level in (0,1,2) then "x" else u.wk_kd_kota end,
							case when r.kode_level in (0,1,2,3) then "x" else u.wk_kd_kel end
							)
					    in (
							select x.kode_role_lower,
								   case when x.kode_level = 0 then "x" else x.kode_kmp end kode_kmp, 
								   case when x.kode_level in (0,1) then "x" else x.kode_kmw end kode_kmw, 
								   case when x.kode_level in (0,1) then "x" else x.kode_prop end wk_kd_prop,
								   case when x.kode_level in (0,1,2) then "x" else x.kode_kota end wk_kd_kota,
								   case when x.kode_level in (0,1,2,3) then "x" else x.kode_kel end wk_kd_kel
							  from (
									select b.kode_level, a.kode_role, e.kode kode_role_lower, a.kode_kmp, a.kode_kmw, 
										   a.kode_korkot, a.kode_faskel, d.kode kode_prop, ifnull(a.wk_kd_kota, h.kode_kota) kode_kota, 
										   ifnull(a.wk_kd_kel, i.kode_kel) kode_kel, e.kode_level kode_level_lower
									  from bkt_02010111_user a 
									  join bkt_02010102_role b on a.kode_role = b.kode
									  join bkt_02010101_role_level c on b.kode_level = c.kode
									  left join bkt_01010101_prop d on a.wk_kd_prop = d.kode
									  left join bkt_02010102_role e on e.kode_role_upper = b.kode
									  left join bkt_01010111_korkot f on f.kode = a.kode_korkot
									  left join bkt_01010113_faskel g on g.kode = a.kode_faskel
									  left join bkt_01010112_kota_korkot h on h.kode_korkot = f.kode
									  left join bkt_01010114_kel_faskel i on i.kode_faskel = g.kode
									 where a.user_name = '.$user->user_name.'
								   ) x 
							)';
			$totalData = DB::select('select count(1) cnt from bkt_02020201_registrasi
									where status_registrasi=0 ');

		}

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
			$posts=DB::select($query. ' where (b.user_name_real like "%'.$search.'%" or 
												b.nama_depan_real like "%'.$search.'%" or
												b.nama_belakang_real like "%'.$search.'%" or
												b.jenis_kel like "%'.$search.'%" or
												b.jenis_reg like "%'.$search.'%" or 
												b.status_reg like "%'.$search.'%") 
										order by '.$order.' '.$dir.' limit '.$start.','.$limit);
			$totalFiltered=DB::select('select count(1) cnt from ('.$query. ' where (b.user_name_real like "%'.$search.'%" or 
												b.nama_depan_real like "%'.$search.'%" or
												b.nama_belakang_real like "%'.$search.'%" or
												b.jenis_kel like "%'.$search.'%" or
												b.jenis_reg like "%'.$search.'%" or 
												b.status_reg like "%'.$search.'%")
										) a');
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
				$jns_sumber_dana = null;

				$url_edit=url('/')."/hrm/management/persetujuan/create?kode=".$edit;
				$url_delete=url('/')."/hrm/management/persetujuan/delete?kode=".$delete;
				$nestedData['user_name'] = $post->user_name;
				$nestedData['nama_depan'] = $post->nama_depan;
				$nestedData['nama_belakang'] = $post->nama_belakang;
				$nestedData['jenis_kel'] = $post->jenis_kel;
				$nestedData['jenis_reg'] = $post->jenis_reg;
				$nestedData['status_reg'] = $post->status_reg;
				$nestedData['created_time'] = $post->created_time;

				$user = Auth::user();
		        $akses= $user->menu()->where('kode_apps', 2)->get();
				if(count($akses) > 0){
					foreach ($akses as $item) {
						if($item->kode_menu==182)
							$detil[$item->kode_menu_detil]='a';
					}
				}

				$option = '';
				if(!empty($detil[571])){
					$option .= "&emsp;<a href='{$url_edit}' title='EDIT' ><span class='fa fa-fw fa-edit'></span></a>";
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
        $akses= $user->menu()->where('kode_apps', 2)->get();
		if(count($akses) > 0){
			foreach ($akses as $item) {
				$data['menu'][$item->kode_menu] =  'a' ;
				if($item->kode_menu==182)
					$data['detil'][$item->kode_menu_detil]='a';
			}
			$data['username'] = $user->name;
			$data['kode']=$request->input('kode');
			$rowData = DB::select('select * from bkt_02020201_registrasi where status_registrasi=0 and kode='.$data['kode']);
				$data['user_name'] = $rowData[0]->user_name;
				$data['password'] = $rowData[0]->password;
				$data['nama_depan'] = $rowData[0]->nama_depan;
				$data['nama_belakang'] = $rowData[0]->nama_belakang;
				$data['nik'] = $rowData[0]->nik;
				$data['no_npwp'] = $rowData[0]->no_npwp;
				$data['kode_level'] = $rowData[0]->kode_level;
				$data['kode_role'] = $rowData[0]->kode_role;
				$data['wk_kd_prop'] = $rowData[0]->wk_kd_prop;
				$data['wk_kd_kota'] = $rowData[0]->wk_kd_kota;
				$data['wk_kd_kel'] = $rowData[0]->wk_kd_kel;
				$data['kode_kmp'] = $rowData[0]->kode_kmp;
				$data['kode_kmw'] = $rowData[0]->kode_kmw;
				$data['kode_korkot'] = $rowData[0]->kode_korkot;
				$data['kode_faskel'] = $rowData[0]->kode_faskel;
				$data['alamat'] = $rowData[0]->alamat;
				$data['kode_prop'] = $rowData[0]->kode_prop;
				$data['kode_kota'] = $rowData[0]->kode_kota;
				$data['kode_kec'] = $rowData[0]->kode_kec;
				$data['kode_kel'] = $rowData[0]->kode_kel;
				$data['kodepos'] = $rowData[0]->kodepos;
				$data['kode_jenis_kelamin'] = $rowData[0]->kode_jenis_kelamin;
				$data['kode_tempat_lahir'] = $rowData[0]->kode_tempat_lahir;
				$data['tgl_lahir'] = $rowData[0]->tgl_lahir;
				$data['email'] = $rowData[0]->email;
				$data['no_hp'] = $rowData[0]->no_hp;
				$data['no_hp2'] = $rowData[0]->no_hp2;
				$data['no_telp'] = $rowData[0]->no_telp;
				$data['no_spk'] = $rowData[0]->no_spk;
				$data['tgl_spk'] = $rowData[0]->tgl_spk;
				$data['nama_bank'] = $rowData[0]->nama_bank;
				$data['no_rekening'] = $rowData[0]->no_rekening;
				$data['jenis_registrasi'] = $rowData[0]->jenis_registrasi;
				$data['status_registrasi'] = $rowData[0]->status_registrasi;
				$data['validated_by'] = $rowData[0]->validated_by;
				$data['validated_time'] = $rowData[0]->validated_time;
				$data['validation_note'] = $rowData[0]->validation_note;
				$data['uri_img_profile'] = $rowData[0]->uri_img_profile;
				$data['created_time'] = $rowData[0]->created_time;
				$data['created_by'] = $rowData[0]->created_by;
				$data['updated_time'] = $rowData[0]->updated_time;
				$data['updated_by'] = $rowData[0]->updated_by;
				$data['data_registrasi_list'] = DB::select('select a.*,
																b.nama nama_kmp,
																c.nama nama_kmw,
																d.nama nama_kota,
																e.nama nama_korkot,
																f.nama nama_kec,
																g.nama nama_kel,
																h.nama nama_faskel,
																i.nama nama_prop,
																j.nama nama_level,
																k.nama nama_role,
																l.nama nama_tempat_lahir,
														   case
																when a.kode_jenis_kelamin = "P" then "Pria"
																when a.kode_jenis_kelamin = "W" then "Wanita"
															end nama_kelamin
														   from bkt_02020201_registrasi a
														   		left join bkt_01010108_kmp b on a.kode_kmp=b.kode 
														   		left join bkt_01010110_kmw c on a.kode_kmw=c.kode
																left join bkt_01010102_kota d on a.kode_kota=d.kode 
																left join bkt_01010111_korkot e on a.kode_korkot=e.kode
																left join bkt_01010103_kec f on a.kode_kec=f.kode
																left join bkt_01010104_kel g on a.kode_kel=g.kode
																left join bkt_01010113_faskel h on a.kode_faskel=h.kode
																left join bkt_01010101_prop i on a.kode_prop=i.kode
																left join bkt_02010101_role_level j on a.kode_level=j.kode
																left join bkt_02010102_role k on a.kode_role=k.kode
																left join bkt_01010102_kota l on a.kode_tempat_lahir=l.kode
														   where a.status_registrasi=0 and a.kode='.$data['kode']);
				$data['kode_user_list'] = DB::select('select * from bkt_02010111_user');
			return view('HRM/bk020316/create',$data);
		}
	}

	public function post_create(Request $request)
	{
			date_default_timezone_set('Asia/Jakarta');
			DB::table('bkt_02010111_user')
			->insert([
				'user_name' => $request->input('user_name-input'),
				'password' => $request->input('password-input'),
				'nama_depan' => $request->input('nama_depan-input'),
				'nama_belakang' => $request->input('nama_belakang-input'),
				'nik' => $request->input('nik-input'),
				'no_npwp' => $request->input('no_npwp-input'),
				'kode_level' => $request->input('select-kode_level-input'),
				'kode_role' => $request->input('select-kode_role-input'),
				'wk_kd_prop' => $request->input('select-wk_kd_prop-input'),
				'wk_kd_kota' => $request->input('select-wk_kd_kota-input'),
				'wk_kd_kel' => $request->input('select-wk_kd_kel-input'),
				'kode_kmp' => $request->input('select-kode_kmp-input'),
				'kode_kmw' => $request->input('select-kode_kmw-input'),
				'kode_korkot' => $request->input('select-kode_korkot-input'),
				'kode_faskel' => $request->input('select-kode_faskel-input'),
				'alamat' => $request->input('alamat-input'),
				'kode_jenis_kelamin' => $request->input('select-kode_jenis_kelamin-input'),
				'kode_kota_lahir' => $request->input('select-kode_kota_lahir-input'),
				'tgl_lahir' => $request->input('tgl_lahir-input'),
				'kode_prop' => $request->input('select-kode_prop-input'),
				'kode_kota' => $request->input('select-kode_kota-input'),
				'kode_kec' => $request->input('select-kode_kec-input'),
				'kode_kel' => $request->input('select-kode_kel-input'),
				'kodepos' => $request->input('kodepos-input'),
				'email' => $request->input('email-input'),
				'no_hp' => $request->input('no_hp-input'),
				'no_hp2' => $request->input('no_hp2-input'),
				'no_telp' => $request->input('no_telp-input'),
				'no_spk' => $request->input('no_spk-input'),
				'tgl_spk' => $request->input('tgl_spk-input'),
				'nama_bank' => $request->input('nama_bank-input'),
				'no_rekening' => $request->input('no_rekening-input'),
				'status_registrasi' => '1',
				'status_personil' => '1',
				'jenis_registrasi' => $request->input('select-jenis_registrasi-input'),
				'validation_note' => $request->input('validation_note-input'),
				'validated_by' => Auth::user()->id,
				'validated_time' => date('Y-m-d H:i:s'),
				'updated_by' => Auth::user()->id,
				'updated_time' => date('Y-m-d H:i:s')
				]);

			DB::table('bkt_02020201_registrasi')->where('kode', $request->input('kode'))
			->update([
				'status_registrasi' => '1',
				'validated_by' => Auth::user()->id,
				'validated_time' => date('Y-m-d H:i:s'),
				'updated_by' => Auth::user()->id,
				'updated_time' => date('Y-m-d H:i:s')
				]);
			$this->log_aktivitas('Update', 571);
		
	}

	public function post_tolak(Request $request)
	{
			DB::table('bkt_02020201_registrasi')->where('kode', $request->input('kode'))
			->update([
				'status_registrasi' => '2',
				'updated_by' => Auth::user()->id,
				'updated_time' => date('Y-m-d H:i:s')
				]);
			$this->log_aktivitas('Update', 571);
		
	}

	public function date_conversion($date)
	{
        $date_convert = date('Y-m-d', strtotime($date));
        return $date_convert;
	}

    public function log_aktivitas($aktifitas, $detil)
    {
    	DB::table('bkt_02030201_log_aktivitas')->insert([
				'kode_user' => Auth::user()->id,
				'kode_apps' => 2,
				'kode_modul' => 14,
				'kode_menu' => 182,
				'kode_menu_detil' => $detil,
				'aktifitas' => $aktifitas,
				'deskripsi' => $aktifitas
       			]);
    }
}

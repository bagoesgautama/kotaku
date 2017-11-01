<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
// use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;


class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:bkt_02010111_user',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }

    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        $this->guard()->login($user);

        return $this->registered($request, $user)
                        ?: redirect($this->redirectPath());
    }

    public function showRegistrationForm()
    {
        // return view('auth.register');
        $data['level_list']=DB::select('select * from bkt_02010101_role_level');
        // $data['role_list']=DB::select('select * from bkt_02010102_role');
        $data['kmp_list']=DB::select('select * from bkt_01010108_kmp');
        $data['prop_list'] = DB::select('select * from bkt_01010101_prop where status=1');
        $data['kota_list'] = DB::select('select * from bkt_01010102_kota where status=1');
        $data['wk_kd_prop_list'] = DB::select('select * from bkt_01010101_prop where status=1 and flag_cakupan_prog=1');
        // $data['kec_list'] = DB::select('select * from bkt_01010103_kec where status=1');
        // $data['kel_list'] = DB::select('select * from bkt_01010104_kel where status=1');
        return view('register', $data);
    }

    public function select(Request $request)
    {
        if($request->input('level')){
            $role = DB::select('select kode, nama, flag_koordinator from bkt_02010102_role where kode_level='.$request->input('level'));
            echo json_encode($role);
        }
        if($request->input('role_flag_koor')){
            $role = DB::select('select kode, nama, flag_koordinator, kode_level from bkt_02010102_role where kode='.$request->input('role_flag_koor'));
            echo json_encode($role);
        }
        if($request->input('prop')){
            $kota = DB::select('select kode, nama from bkt_01010102_kota where kode_prop='.$request->input('prop'));
            echo json_encode($kota);
        }
        if($request->input('kota')){
            $kec = DB::select('select kode, nama from bkt_01010103_kec where kode_kota='.$request->input('kota'));
            echo json_encode($kec);
        }
        if($request->input('kec')){
            $kel = DB::select('select kode, nama from bkt_01010104_kel where kode_kec='.$request->input('kec'));
            echo json_encode($kel);
        }
        if($request->input('wk_kd_prop')){
            $kota = DB::select('select b.kode, b.nama from bkt_01010101_prop a, bkt_01010102_kota b where b.kode_prop=a.kode and a.flag_cakupan_prog=1 and b.flag_cakupan_prog=1 and b.kode_prop='.$request->input('wk_kd_prop'));
            echo json_encode($kota);
        }
        if($request->input('wk_kd_prop_kmw')){
            $kota = DB::select('select b.kode, b.nama from bkt_01010101_prop a, bkt_01010110_kmw b where b.kode_prop=a.kode and a.flag_cakupan_prog=1 and b.kode_prop='.$request->input('wk_kd_prop_kmw'));
            echo json_encode($kota);
        }
        if($request->input('wk_kd_prop_kota')){
            $kota = DB::select('select b.kode, b.nama from bkt_01010101_prop a, bkt_01010102_kota b where b.kode_prop=a.kode and a.flag_cakupan_prog=1 and b.flag_cakupan_prog=1 and b.kode_prop='.$request->input('wk_kd_prop_kota'));
            echo json_encode($kota);
        }
        if($request->input('wk_kd_kota_kec')){
            $kota = DB::select('select b.kode, b.nama from bkt_01010102_kota a, bkt_01010103_kec b where b.kode_kota=a.kode and a.flag_cakupan_prog=1 and b.flag_cakupan_prog=1 and b.kode_kota='.$request->input('wk_kd_kota_kec'));
            echo json_encode($kota);
        }
        if($request->input('wk_kd_kec_kel')){
            $kota = DB::select('select b.kode, b.nama from bkt_01010103_kec a, bkt_01010104_kel b where b.kode_kec=a.kode and a.flag_cakupan_prog=1 and b.flag_cakupan_prog=1 and b.kode_kec='.$request->input('wk_kd_kec_kel'));
            echo json_encode($kota);
        }
        if($request->input('wk_kd_kmw_korkot')){
            $kota = DB::select('select b.kode, b.nama from bkt_01010110_kmw a, bkt_01010111_korkot b where b.kode_kmw=a.kode and b.kode_kmw='.$request->input('wk_kd_kmw_korkot'));
            echo json_encode($kota);
        }
        if($request->input('wk_kd_kmw_faskel')){
            $kota = DB::select('select b.kode, b.nama from bkt_01010110_kmw a, bkt_01010113_faskel b where b.kode_kmw=a.kode and b.kode_kmw='.$request->input('wk_kd_kmw_faskel'));
            echo json_encode($kota);
        }
        if($request->input('wk_kd_kota')){
            $kel = DB::select('select c.kode, c.nama from bkt_01010102_kota a, bkt_01010103_kec b, bkt_01010104_kel c where b.kode_kota=a.kode and c.kode_kec=b.kode and a.flag_cakupan_prog=1 and b.flag_cakupan_prog=1 and c.flag_cakupan_prog=1 and a.kode='.$request->input('wk_kd_kota'));
            echo json_encode($kel);
        }
    }
}

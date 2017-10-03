<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $table = 'bkt_02010109_akses_role_detail';

    public function menu()
    {
        $this->belongsTo('App\User', 'kode_role', 'kode_role');
    }
	public function modul()
    {
        $this->hasMany('App\MenuName', 'kode_menu', 'kode');
    }
}

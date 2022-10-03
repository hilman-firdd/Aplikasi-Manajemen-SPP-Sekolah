<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Siswa extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 't_siswa';
    protected $guarded = [];

    public function kelas(){
        return $this->hasOne('App\Models\Kelas','id','kelas_id');
    }

    public function transaksi(){
        return $this->hasMany('App\Models\Transaksi','siswa_id','id');
    }

    public function tabungan(){
        return $this->hasMany('App\Models\Tabungan','siswa_id','id');
    }

    public function role(){
        return $this->hasMany('App\Models\M_role','siswa_id','id');
    }
}

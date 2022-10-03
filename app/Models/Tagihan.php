<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tagihan extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 't_tagihan';
    protected $fillable = [
        'nama',
        'jumlah',
        'wajib_semua',
        'kelas_id',
        'is_bayar'
    ];

    public function transaksi(){
        return $this->hasMany('App\Models\Transaksi','tagihan_id','id');
    }

    public function transaksiToday(){
        return $this->transaksi()->whereDate('created_at', now()->today());
    }

    public function role(){
        return $this->hasMany('App\Models\M_role','tagihan_id','id');
    }

    public function siswa(){
        return $this->belongsToMany('App\Models\Siswa','t_role');
    }

    public function kelas(){
        return $this->hasOne('App\Models\Kelas','id','kelas_id');
    }

    public function getJumlahIdrAttribute(){
        return "IDR. ".format_idr($this->jumlah);
    }
}

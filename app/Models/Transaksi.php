<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaksi extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 't_transaksi';
    protected $guarded = [];

    public function tagihan()
    {
        return $this->hasOne('App\Models\Tagihan', 'id', 'tagihan_id');
    }

    public function siswa()
    {
        return $this->hasOne('App\Models\Siswa', 'id', 'siswa_id');
    }

    public function keuangan()
    {
        return $this->hasOne('App\Models\Keuangan', 'transaksi_id', 'id');
    }
}

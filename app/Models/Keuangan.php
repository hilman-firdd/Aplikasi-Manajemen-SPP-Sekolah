<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Keuangan extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = [];
    protected $table = 't_keuangan';

    public function tabungan()
    {
        return $this->hasOne('App\Models\Tabungan', 'id', 'tabungan_id');
    }

    public function transaksi()
    {
        return $this->hasOne('App\Models\Transaksi', 'id', 'transaksi_id');
    }
}

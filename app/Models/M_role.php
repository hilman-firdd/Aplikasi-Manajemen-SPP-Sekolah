<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class M_role extends Model
{
    use HasFactory;
    protected $table = 't_role';

    protected $guarded = [];

    public function siswa()
    {
        return $this->hasOne('App\Models\Siswa', 'id', 'siswa_id');
    }

    public function tagihan()
    {
        return $this->hasOne('App\Models\Tagihan', 'id', 'tagihan_id');
    }
}

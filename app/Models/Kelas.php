<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kelas extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];
    protected $table = 't_kelas';

    public function periode(){
        return $this->hasOne('App\Models\Periode','id','periode_id');
    }

    public function siswa(){
        return $this->hasMany('App\Models\Siswa', 'kelas_id', 'id');
    }
}

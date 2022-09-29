<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Periode extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = [];
    protected $table = 't_periode';

    public function kelas(){
        return $this->hasMany('App\Models\Kelas','periode_id','id');
    }
}

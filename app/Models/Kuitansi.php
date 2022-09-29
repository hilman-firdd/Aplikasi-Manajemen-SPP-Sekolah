<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kuitansi extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 't_kuitansi';

    protected $fillable = [
        'invoice',
        'items',
        'total'
    ];
}

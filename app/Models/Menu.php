<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;
    protected $table = 't_menu';
    protected $guarded = [];

    public function permissions()
    {
        return $this->belongsToMany('App\Models\Permission');
    }
}

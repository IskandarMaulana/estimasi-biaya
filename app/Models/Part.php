<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Part extends Model
{
    protected $primaryKey = 'id_part';
    public $incrementing = false;
    protected $fillable = [
        'id_part',
        'nama_part',
        'tipe_mobil',
        'no_part',
        'no_part_eff',
        'no_part_carb',
        'harga_part_eff',
        'harga_part_carb',
        'stock_plan',
        'stock_actual',
        'selisih'
    ];
}
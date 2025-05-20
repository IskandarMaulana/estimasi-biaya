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
        'harga_part'
    ];
}
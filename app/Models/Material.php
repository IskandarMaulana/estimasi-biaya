<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    protected $primaryKey = 'no_material';
    public $incrementing = false;
    protected $fillable = ['no_material', 'nama_material', 'jenis_material', 'harga_satuan'];
}
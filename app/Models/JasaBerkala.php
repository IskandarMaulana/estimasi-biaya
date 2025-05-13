<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JasaBerkala extends Model
{
    protected $primaryKey = 'id_jasa';
    protected $keyType = 'string';
    protected $fillable = ['id_jasa', 'tipe_mobil', 'jenis_service', 'biaya_jasa'];
}
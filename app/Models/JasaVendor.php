<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JasaVendor extends Model
{
    protected $primaryKey = 'id_jasa';
    protected $keyType = 'string';
    protected $fillable = ['id_jasa', 'jasa', 'harga'];
}
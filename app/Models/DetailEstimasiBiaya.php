<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailEstimasiBiaya extends Model
{
    protected $primaryKey = 'id_detail_estimasi';
    protected $keyType = 'string';
    protected $fillable = [
        'id_detail_estimasi', 'id_estimasi', 'nama', 'detail_type',
        'harga_satuan', 'qty', 'discount', 'jumlah', 'keterangan'
    ];

    public function estimasiBiaya() {
        return $this->belongsTo(EstimasiBiaya::class, 'id_estimasi');
    }
}
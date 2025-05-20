<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstimasiBiaya extends Model
{
    protected $primaryKey = 'id_estimasi';
    protected $keyType = 'string';
    protected $fillable = [
        'id_estimasi',
        'nama',
        'no_polis',
        'tipe_mobil',
        'km_aktual',
        'tanggal_transaksi',
        'total_jasa',
        'total_barang',
        'total_biaya',
        'id_user'
    ];
    public function details()
    {
        return $this->hasMany(DetailEstimasiBiaya::class, 'id_estimasi', 'id_estimasi');
    }
    
    // Relationship to User
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }
}
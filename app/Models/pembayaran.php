<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pembayaran extends Model
{
    use HasFactory;

    protected $table = 'pembayaran';
    protected $primaryKey = 'id_pembayaran';

    protected $fillable = [
        'id_pemesanan',
        'id_pegawai',
        'tanggal_pembayaran',
        'metode_pembayaran',
        'total_pembayaran',
        'status',
    ];

    public function pemesanan(){
        return $this->belongsTo(pemesanan::class, 'id_pemesanan');
    }

    public function pegawai(){
        return $this->belongsTo(pegawai::class, 'id_pegawai');
    }
}

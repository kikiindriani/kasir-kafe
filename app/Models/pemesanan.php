<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pemesanan extends Model
{
    use HasFactory;

    protected $table = 'pemesanan';
    protected $primaryKey = 'id_pemesanan';

    protected $fillable = [
        'jumlah',
        'total_harga',
        'tanggal_pemesanan',
        'nomor_meja',
        'id_member',
        'diskon',
    ];

    public function member(){
        return $this->belongsTo(member::class, 'id_member');    
    }

    public function detailPemesanan(){
        return $this->hasMany(detail_pemesanan::class, 'id_pemesanan');
    }

    public function pembayaran(){
        return $this->hasOne(pembayaran::class, 'id_pemesanan');
    }
}

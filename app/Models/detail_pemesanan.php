<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class detail_pemesanan extends Model
{
    use HasFactory;

    protected $table = 'detail_pemesanan';
    protected $primaryKey = 'id_detail_pemesanan';

    protected $fillable = [
        'id_pemesanan',
        'id_menu',
        'jumlah',
    ];

    public function pemesanan(){
        return $this->belongsTo(pemesanan::class, 'id_pemesanan');
    } 

    public function menu(){
        return $this->belongsTo(menu::class, 'id_menu');
    }
}

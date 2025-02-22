<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class menu extends Model
{
    use HasFactory;

    protected $table = 'menu';
    protected $primaryKey = 'id_menu';

    protected $fillable = [
        'nama_menu',
        'jenis_menu',
        'harga',
        'image_name'
    ];

    public function detailPemesanan(){
        return $this->hasMany(detail_pemesanan::class, 'id_menu');
    }
}

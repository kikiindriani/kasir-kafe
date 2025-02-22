<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class member extends Model
{
    use HasFactory;

    protected $table = 'member';
    protected $primaryKey = 'id_member';    

    protected $fillable = [
        'username',
        'password',
        'telp',
        'id_pegawai'
    ];

    public function pegawai(){
        return $this->belongsTo(pegawai::class, 'id_pegawai');
    }

    public function pembayaran(){
        return $this->hasMany(pembayaran::class, 'id_member');
    }
}

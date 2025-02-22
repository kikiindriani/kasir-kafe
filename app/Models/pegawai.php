<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pegawai extends Model
{
    use HasFactory;

    protected $table = 'pegawai';
    protected $primaryKey = 'id_pegawai';

    protected $fillable = [
        'nama_pegawai',
        'username',
        'password',
        'id_level'
    ];

    public function level(){
        return $this->belongsTo(level::class, 'id_level');  
    }

    public function member(){
        return $this->hasOne(member::class, 'id_pegawai');
    }

    public function pembayaran(){
        return $this->hasMany(pembayaran::class, 'id_pegawai');
    }
}

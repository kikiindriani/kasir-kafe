<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class level extends Model
{
    use HasFactory;

    protected $table = 'levels';
    protected $primaryKey = 'id_level';

    protected $fillable = [
        'level'
    ];

    public function pegawai()
    {
        return $this->hasMany(pegawai::class, 'id_level');
    }   
}

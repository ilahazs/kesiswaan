<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KlasifikasiPenghargaan extends Model
{
    use HasFactory;

    protected $table = 'klasifikasi_penghargaan';
    protected $guarded = ['id'];
    protected $load = ['penghargaans'];



    public function penghargaans()
    {
        return $this->hasMany(Penghargaan::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KlasifikasiPelanggaran extends Model
{
    use HasFactory;
    protected $table = 'klasifikasi_pelanggaran';
    protected $guarded = ['id'];
    // protected $with = ['pelanggarans'];
    protected $load = ['pelanggarans'];




    public function pelanggarans()
    {
        return $this->hasMany(Pelanggaran::class);
    }
}

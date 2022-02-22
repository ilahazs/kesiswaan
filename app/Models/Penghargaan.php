<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penghargaan extends Model
{
    use HasFactory;
    protected $table = 'data_penghargaan';
    protected $guarded = ['id'];
    protected $with = ['klasifikasi'];


    public function students()
    {
        return $this->belongsToMany(Student::class, 'student_penghargaan', 'penghargaan_id', 'student_id');
    }

    public function klasifikasi()
    {
        return $this->belongsTo(KlasifikasiPenghargaan::class, 'klasifikasi_id');
    }
}

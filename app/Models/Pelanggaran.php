<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelanggaran extends Model
{
    use HasFactory;
    protected $table = 'data_pelanggaran';
    protected $guarded = ['id'];
    protected $with = ['klasifikasi'];


    public function students()
    {
        return $this->belongsToMany(Student::class, 'student_pelanggaran', 'pelanggaran_id', 'student_id');
    }

    public function klasifikasi()
    {
        return $this->belongsTo(KlasifikasiPelanggaran::class, 'klasifikasi_id');
    }
}

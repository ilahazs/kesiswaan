<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $with = ['kelas', 'pelanggarans', 'penghargaans'];

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'class_id');
    }
    public function pelanggarans()
    {
        return $this->belongsToMany(Pelanggaran::class, 'student_pelanggaran', 'student_id', 'pelanggaran_id');
    }

    public function penghargaans()
    {
        return $this->belongsToMany(Penghargaan::class, 'student_penghargaan', 'student_id', 'penghargaan_id');
    }

    public function getRouteKeyName()
    {
        return 'nis';
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $load = ['kelas', 'rule_data'];

    public function students()
    {
        return $this->hasMany(Student::class);
    }
}

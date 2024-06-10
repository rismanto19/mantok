<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prodi extends Model
{
    use HasFactory;

    protected $fillable = ['nama', 'singkatan', 'fakultas_id'];

    public function fakultas() {
        return $this->belongsTo(Fakultas::class, 'fakultas_id');
        // return $this->belongsTo(Fakultas::class, 'foreign_key');
        // 1 prodi 1 fakultas belongTo
        // 1 fakultas > 1 prodi hasMany()
    }
}

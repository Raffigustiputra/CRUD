<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class dataSiswa extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'nis',
        'rayon',
        'rombel',
        'eskul',
    ];
}

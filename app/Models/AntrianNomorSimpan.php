<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AntrianNomorSimpan extends Model
{
    use HasFactory;

    protected $fillable = [
        'nomor_antrian',
        'nama',
        'telepon',
        'customer_filter_id',
        'jabatan',
        'mulai',
        'selesai'
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SitumpurAntrianCsNomor extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'nomor_antrian',
        'nama_customer',
        'telepon',
        'customer_filter_id',
        'status'
    ];
}

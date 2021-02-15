<?php

namespace App\Models;

use App\Models\MasterKaryawan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SitumpurAntrianDesainNomor extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'nomor_antrian',
        'nama_customer',
        'telepon',
        'customer_filter_id',
        'status',
        'master_karyawan_id'
    ];

    public function masterKaryawan() {
        return $this->belongsTo(MasterKaryawan::class);
    }
}

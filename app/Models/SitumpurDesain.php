<?php

namespace App\Models;

use App\Models\MasterKaryawan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SitumpurDesain extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'nomor',
        'master_karyawan_id',
        'status'
    ];

    public function masterKaryawan() {
        return $this->belongsTo(MasterKaryawan::class);
    }
}

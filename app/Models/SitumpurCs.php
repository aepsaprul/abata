<?php

namespace App\Models;

use App\Models\MasterKaryawan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SitumpurCs extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'nomor',
        'karyawa_id',
        'status'
    ];

    public function karyawan() {
        return $this->belongsTo(MasterKaryawan::class, 'karyawan_id');
    }
}

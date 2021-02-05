<?php

namespace App\Models;

use App\Models\Karyawan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Desainer extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'title',
        'karyawan_id',
        'status'
    ];

    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class);
    }
}

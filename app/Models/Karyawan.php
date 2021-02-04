<?php

namespace App\Models;

use App\Models\User;
use App\Models\Jabatan;
use App\Models\Desainer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Karyawan extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'nama_lengkap',
        'alamat',
        'email',
        'telepon',
        'jabatan_id',
        'foto'
    ];

    public function jabatan() {
        return $this->belongsTo(Jabatan::class, 'jabatan_id');
    }

    public function desainer() {
        return $this->hasOne(Desainer::class, 'karyawan_id');
    }

    public function user() {
        return $this->hasOne(User::class);
    }
}

<?php

namespace App\Models;

use App\Models\User;
use App\Models\SitumpurCs;
use App\Models\MasterCabang;
use App\Models\MasterJabatan;
use App\Models\SitumpurDesain;
use Illuminate\Database\Eloquent\Model;
use App\Models\SitumpurAntrianDesainNomor;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MasterKaryawan extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'nik',
        'nama_lengkap',
        'nama_panggilan',
        'telepon',
        'email',
        'nomor_ktp',
        'status_ktp',
        'foto',
        'cabang_id',
        'jabatan_id',
        'jenis_kelamin',
        'tempat_lahir',
        'tanggal_lahir',
        'alamat_asal',
        'alamat_domisili',
        'tanggal_masuk',
        'tanggal_keluar',
        'alasan',
        'tanggal_pengambilan_ijazah',
        'status'
    ];

    public function masterCabang() {
        return $this->belongsTo(MasterCabang::class);
    }

    public function masterJabatan() {
        return $this->belongsTo(MasterJabatan::class);
    }

    public function user() {
        return $this->hasOne(User::class);
    }

    public function situmpurDesain() {
        return $this->hasOne(SitumpurDesain::class);
    }

    public function situmpurCs() {
        return $this->hasOne(SitumpurCs::class);
    }

    public function situmpurAntrianDesainNomor() {
        return $this->hasMany(SitumpurAntrianDesainNomor::class);
    }
}

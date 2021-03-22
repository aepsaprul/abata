<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AntrianPengunjung;
use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
{
    public function pengunjung()
    {
        $antrianPengungjung = AntrianPengunjung::where('status', '!=', 0)->with('masterKaryawan')->get();
        return view('laporan.pengunjung', ['pengunjungs' => $antrianPengungjung]);
    }
    public function pengunjungData()
    {
        $antrianPengungjung = AntrianPengunjung::where('status', '!=', 0)->with('masterKaryawan')->get();
        $mapAntrian = $antrianPengungjung->map(function ($item, $key) {
            return [
                'id' => $key + 1,
                'nama_customer' => $item->nama_customer,
                'telepon' => $item->telepon,
                'customer_filter_id' => $item->customer_filter_id,
                'master_karyawan_id' => $item->master_karyawan_id,
                'nama_karyawan' => $item->masterKaryawan->nama_lengkap,
                'tanggal' => $item->tanggal,
                'master_cabang_id' => $item->master_cabang_id
            ];
        });
        return datatables ($mapAntrian)->toJson();
    }
    public function pengunjungRangeTgl(Request $request)
    {
        

        $antrianPengungjung = AntrianPengunjung::whereBetween(
                DB::raw('DATE(tanggal)'), [$request->startDate, $request->endDate]    
            )
        ->where('status', '!=', 0)
        ->with('masterKaryawan')->get();
        $mapAntrian = $antrianPengungjung->map(function ($item, $key) {
            
            $waktuawal  = date_create($item->mulai); //waktu di setting
            $waktuakhir = date_create($item->selesai); //2019-02-21 09:35 waktu sekarang
            $diff  = date_diff($waktuawal, $waktuakhir);

            if ($diff->h == 0) {
                $waktu = $diff->i . " menit " . $diff->s . " detik";      
            } else {
                $waktu = $diff->h . " jam " . $diff->i . " menit " . $diff->s . " detik";
            }

            // echo 'Selisih waktu: ';

            // echo $diff->y . ' tahun, ';

            // echo $diff->m . ' bulan, ';

            // echo $diff->d . ' hari, ';

            // echo $diff->h . ' jam, ';

            // echo $diff->i . ' menit, ';

            // echo $diff->s . ' detik, ';

            // Output : Selisih waktu: 0 tahun, 11 bulan, 30 hari, 18 jam, 35 menit, 11 detik

            return [
                'id' => $key + 1,
                'nama_customer' => $item->nama_customer,
                'telepon' => $item->telepon,
                'customer_filter_id' => $item->customer_filter_id,
                'master_karyawan_id' => $item->master_karyawan_id,
                'nama_karyawan' => $item->masterKaryawan->nama_lengkap,
                'tanggal' => $item->tanggal,
                'master_cabang_id' => $item->master_cabang_id,
                'waktu' => $waktu
            ];
        });
        return datatables ($mapAntrian)->toJson();
    }
}

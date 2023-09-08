<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Guru;
use App\Models\Jadwal;
use App\Models\Kelas;
use App\Models\siswa;
use Illuminate\Http\Request;

class AbsensiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Setel lokal bahasa menjadi bahasa Indonesia
        setlocale(LC_TIME, 'id_ID');

        // Daftar nama hari dalam bahasa Indonesia
        $hariIndonesia = [
            'Sunday' => 'Minggu',
            'Monday' => 'Senin',
            'Tuesday' => 'Selasa',
            'Wednesday' => 'Rabu',
            'Thursday' => 'Kamis',
            'Friday' => 'Jumat',
            'Saturday' => 'Sabtu',
        ];

        // Mendapatkan nama hari dalam bahasa Indonesia berdasarkan tanggal saat ini
        $hariIni = date('l'); // Menghasilkan nama hari dalam bahasa Inggris
        $hariIndonesiaIni = $hariIndonesia[$hariIni];
        $guru = Guru::where('nip', auth()->user()->reference_id)->first();
        $jadwal = Jadwal::where(['guru_id' => $guru->id, 'hari' => $hariIndonesiaIni])->get();
        return view('menuguru.absensi.index', ['guru' => $guru, 'jadwal' => $jadwal]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function list_absen($kelasId, $jadwalId)
    {
        $absensi = Absensi::where('jadwal_id', $jadwalId)->count();
        if ($absensi <= 0) {
            $siswa = siswa::where('kelas_id', $kelasId)->get();
            return view('menuguru.absensi.detail', ['jadwal_id' => $jadwalId, 'siswa' => $siswa]);
        } else {
            return view('menuguru.absensi.detail', ['jadwal_id' => $jadwalId]);
        }
    }
    public function storeBulk(Request $request, $kelasId, $jadwalId)
    {
        // Validasi request sesuai kebutuhan Anda

        $absensiData = $request->input('absensi');

        // Loop melalui data absensi yang dikirimkan
        foreach ($absensiData as $siswaId => $status) {
            // Buat objek Absensi dan simpan ke database
            $absensi = new Absensi();
            $absensi->jadwal_id = $jadwalId;
            $absensi->siswa_id = $siswaId;
            $absensi->status = $status;
            $absensi->tanggal_absensi = date("Y-m-d");
            $absensi->save();
        }

        // Redirect ke halaman yang sesuai dengan kebutuhan Anda
        return redirect()->route('absensi.guru.index')->with('success', 'Data absensi berhasil disimpan.');
    }
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

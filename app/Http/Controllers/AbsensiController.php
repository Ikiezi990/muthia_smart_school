<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Guru;
use App\Models\Jadwal;
use App\Models\Kelas;
use App\Models\siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        $absensi = Absensi::where(['jadwal_id' => $jadwalId, "tanggal_absensi" => date("Y-m-d")])->count();
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
    public function historyAbsensiTanggal()
    {
        $guru = Guru::where('nip', auth()->user()->reference_id)->first();
        $jadwal = Jadwal::where('guru_id', $guru->id)->get();
        return view("menuguru.absensi.historytanggal", ["jadwal" => $jadwal]);
    }
    public function historyAbsensiTanggalSiswa()
    {
        $siswa = siswa::where('nisn', auth()->user()->reference_id)->first();
        $jadwal = Jadwal::where('kelas_id', $siswa->kelas_id)->get();
        return view("menusiswa.absensi.historytanggal", ["jadwal" => $jadwal]);
    }
    public function getStudentAttendance(Request $request)
    {
        // Retrieve filter parameters from the AJAX request
        $jadwal_id = $request->input('jadwal_id');

        $tanggal_awal = $request->input('tanggal_awal');
        $tanggal_akhir = $request->input('tanggal_akhir');
        $jadwal = Jadwal::where('id', $jadwal_id)->first();
        // Query to retrieve students based on kelas_id from the jadwal table
        $students = siswa::where('kelas_id', $jadwal->kelas_id)->get();


        // Initialize an array to store student data
        $studentData = [];

        // Loop through each student and calculate their attendance counts
        foreach ($students as $student) {
            $attendanceStatus = $student->absensi()
                ->where('jadwal_id', $jadwal_id)
                ->whereBetween('tanggal_absensi', [$tanggal_awal, $tanggal_akhir])
                ->groupBy('status')
                ->select('status', DB::raw('count(*) as count'))
                ->pluck('count', 'status')->toArray();

            // Create an array with student data
            $studentData[] = [
                'nama_lengkap' => $student->nama_lengkap,
                'nisn' => $student->nisn,
                'hadir' => $attendanceStatus['Hadir'] ?? 0,
                'alpa' => $attendanceStatus['Alpa'] ?? 0,
                'izin' => $attendanceStatus['Izin'] ?? 0,
                'sakit' => $attendanceStatus['Sakit'] ?? 0,
            ];
        }

        // Return the student data as JSON
        return response()->json($studentData);
    }
    public function getStudentAttendanceSiswa(Request $request)
    {
        // Retrieve filter parameters from the AJAX request
        $jadwal_id = $request->input('jadwal_id');

        $tanggal_awal = $request->input('tanggal_awal');
        $tanggal_akhir = $request->input('tanggal_akhir');
        $jadwal = Jadwal::where('id', $jadwal_id)->first();
        // Query to retrieve students based on kelas_id from the jadwal table
        $students = siswa::where('nisn', auth()->user()->reference_id)->get();


        // Initialize an array to store student data
        $studentData = [];

        // Loop through each student and calculate their attendance counts
        foreach ($students as $student) {
            $attendanceStatus = $student->absensi()
                ->where('jadwal_id', $jadwal_id)
                ->whereBetween('tanggal_absensi', [$tanggal_awal, $tanggal_akhir])
                ->groupBy('status')
                ->select('status', DB::raw('count(*) as count'))
                ->pluck('count', 'status')->toArray();

            // Create an array with student data
            $studentData[] = [
                'nama_lengkap' => $student->nama_lengkap,
                'nisn' => $student->nisn,
                'hadir' => $attendanceStatus['Hadir'] ?? 0,
                'alpa' => $attendanceStatus['Alpa'] ?? 0,
                'izin' => $attendanceStatus['Izin'] ?? 0,
                'sakit' => $attendanceStatus['Sakit'] ?? 0,
            ];
        }

        // Return the student data as JSON
        return response()->json($studentData);
    }
}

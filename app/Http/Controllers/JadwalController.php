<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jadwal;
use App\Models\Kelas;
use App\Models\Guru;
use App\Models\Mapel;

class JadwalController extends Controller
{
    public function index(Request $request)
    {
        $jadwal = Jadwal::with('guru', 'mapel', 'kelas')->get();
        $kelas = Kelas::all();
        $guru = Guru::all();
        $mapel = Mapel::all();
        return view('jadwals.index', compact('kelas', 'guru', 'mapel', 'jadwal'));
    }

    public function store(Request $request)
    {
        // Validasi data yang diterima dari form
        $request->validate([
            'guru_id' => 'required',
            'kelas_id' => 'required',
            'semester' => 'required',
            'tahun_ajaran' => 'required',
            'hari' => 'required',
            'jam' => 'required',
            'mapel_id' => 'required',
        ]);

        // Buat objek Jadwal baru berdasarkan data dari form
        $jadwal = new Jadwal([
            'guru_id' => $request->input('guru_id'),
            'kelas_id' => $request->input('kelas_id'),
            'semester' => $request->input('semester'),
            'tahun_ajaran' => $request->input('tahun_ajaran'),
            'hari' => $request->input('hari'),
            'jam' => $request->input('jam'),
            'mapel_id' => $request->input('mapel_id'),
        ]);

        // Simpan objek Jadwal ke dalam database
        $jadwal->save();
        return response()->json(['success' => true]);
    }

    public function edit($id)
    {
        $jadwal = Jadwal::with('kelas', 'guru')->find($id);
        return response()->json($jadwal);
    }

    public function update(Request $request, $id)
    {


        $jadwal = Jadwal::findOrFail($id);
        $jadwal->update($request->all());
        return response()->json(['success' => true]);
    }

    public function destroy($id)
    {
        Jadwal::destroy($id);
        return response()->json(['success' => true]);
    }
}

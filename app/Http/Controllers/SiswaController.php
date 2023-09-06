<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use Illuminate\Http\Request;
use App\Models\siswa;

class SiswaController extends Controller
{
    public function index()
    {
        $siswas = Siswa::all();
        $kelas = Kelas::all();
        return view('siswa.index', compact('siswas', 'kelas'));
    }

    public function show($id)
    {
        $siswa = Siswa::findOrFail($id);
        $kelas = Kelas::where('id', $siswa->kelas_id)->first();
        $siswa["kelas"] = $kelas->nama_kelas;
        return response()->json($siswa);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_lengkap' => 'required',
            'nisn' => 'required|unique:siswas',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:laki-laki,perempuan',
            'agama' => 'required',
            'kewarganegaraan' => 'required',
            'alamat' => 'required',
        ]);

        Siswa::create($request->all());
        return response()->json(['success' => true]);
    }

    public function edit($id)
    {
        $siswa = Siswa::findOrFail($id);
        return response()->json($siswa);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_lengkap' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:laki-laki,perempuan',
            'agama' => 'required',
            'kewarganegaraan' => 'required',
            'alamat' => 'required',
        ]);

        $siswa = Siswa::findOrFail($id);
        $siswa->update($request->all());
        return response()->json(['success' => true]);
    }

    public function destroy($id)
    {
        Siswa::destroy($id);
        return response()->json(['success' => true]);
    }
}

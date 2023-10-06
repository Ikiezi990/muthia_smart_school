<?php

namespace App\Http\Controllers;

use App\Models\Kinerja;
use Illuminate\Http\Request;
use App\Models\KinerjaSiswa; // Pastikan Anda mengganti 'KinerjaSiswa' dengan nama model yang sesuai
use App\Models\siswa;

class KinerjaSiswaController extends Controller
{
    public function index()
    {
        // Mengambil data kinerja siswa dari database
        $kinerjaSiswa = KinerjaSiswa::all();
        $siswa = siswa::all();
        $kinerja = Kinerja::all();
        return view('kinerjasiswa.index', ['kinerjaSiswa' => $kinerjaSiswa, 'siswa' => $siswa, 'kinerja' => $kinerja]);
    }

    public function store(Request $request)
    {
        $poin = Kinerja::where('id', $request->kinerja_id)->first()["poin_kinerja"];
        $request["poin"] = $poin;
        KinerjaSiswa::create($request->all());

        return response()->json(['success' => true]);
    }
    public function edit($id)
    {
        $kinerjaSiswa = kinerjaSiswa::findOrFail($id);
        return response()->json($kinerjaSiswa);
    }

    public function update(Request $request, $id)
    {
        // Validasi input jika diperlukan

        $poin = Kinerja::where('id', $request->kinerja_id)->first()["poin_kinerja"];
        $request["poin"] = $poin;
        // Update data kinerja siswa dalam database
        $kinerjaSiswa = KinerjaSiswa::findOrFail($id);
        $kinerjaSiswa->update($request->all());

        return response()->json(['success' => true]);
    }

    public function destroy($id)
    {
        // Hapus data kinerja siswa dari database
        KinerjaSiswa::destroy($id);

        return response()->json(['message' => 'Data kinerja siswa berhasil dihapus']);
    }
}

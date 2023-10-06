<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Siswa;
use App\Models\Tabungan;

class TabunganController extends Controller
{
    public function index()
    {
        $siswas = siswa::all();
        return view('tabungan.index', compact('siswas'));
    }

    public function show($id)
    {
        $siswa = siswa::findOrFail($id);
        $tabungans = Tabungan::where('siswa_id', $id)->get();
        $totalTabungan = $tabungans->sum('nominal');

        return view('tabungan.show', compact('siswa', 'tabungans', 'totalTabungan'));
    }


    public function create(Request $request)
    {
        $siswa = siswa::findOrFail($request->siswa_id);
        return view('tabungan.create', compact('siswa'));
    }

    public function store(Request $request)
    {
        $tabungan = new Tabungan();
        $tabungan->siswa_id = $request->siswa_id;
        $tabungan->tanggal_menabung = $request->tanggal_menabung;
        $tabungan->nominal = $request->nominal;
        $tabungan->save();

        return redirect()->route('tabungan.show', $request->siswa_id)
            ->with('success', 'Tabungan berhasil ditambahkan');
    }
    public function edit($id)
    {
        $tabungan = Tabungan::findOrFail($id);
        return view('tabungan.edit', compact('tabungan'));
    }

    public function update(Request $request, $id)
    {
        $tabungan = Tabungan::findOrFail($id);
        $tabungan->tanggal_menabung = $request->tanggal_menabung;
        $tabungan->nominal = $request->nominal;
        $tabungan->save();

        return redirect()->route('tabungan.show', $tabungan->siswa_id)
            ->with('success', 'Tabungan berhasil diubah');
    }
    public function destroy($id)
    {
        $tabungan = Tabungan::findOrFail($id);
        $siswaId = $tabungan->siswa_id;
        $tabungan->delete();

        return redirect()->route('tabungan.show', $siswaId)
            ->with('success', 'Tabungan berhasil dihapus');
    }
}

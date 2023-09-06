<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kelas;
use App\Models\Angkatan;

class KelasController extends Controller
{
    public function index()
    {
        $kelases = Kelas::with('angkatan')->get();
        $angkatans = Angkatan::all();
        return view('kelas.index', compact('kelases', 'angkatans'));
    }

    public function store(Request $request)
    {
        Kelas::create($request->all());
        return response()->json(['success' => true]);
    }

    public function edit($id)
    {
        $kelas = Kelas::findOrFail($id);
        return response()->json($kelas);
    }

    public function update(Request $request, $id)
    {
        $kelas = Kelas::findOrFail($id);
        $kelas->update($request->all());
        return response()->json(['success' => true]);
    }

    public function destroy($id)
    {
        Kelas::destroy($id);
        return response()->json(['success' => true]);
    }
}

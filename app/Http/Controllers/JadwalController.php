<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jadwal;
use App\Models\Kelas;
use App\Models\Guru;

class JadwalController extends Controller
{
    public function index(Request $request)
    {

        if ($request->ajax()) {
            $jadwals = Jadwal::with('kelas', 'guru')->get();
            return response()->json($jadwals);
        }
        $kelas = Kelas::all();
        $guru = Guru::all();

        return view('jadwals.index', compact('kelas', 'guru'));
    }

    public function store(Request $request)
    {

        Jadwal::create($request->all());
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

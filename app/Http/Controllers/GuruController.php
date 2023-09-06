<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Guru;

class GuruController extends Controller
{
    public function index()
    {
        $gurus = Guru::all();
        return view('guru.index', compact('gurus'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'nip' => 'required|unique:gurus|max:255',
            'nama' => 'required|max:255',
            'no_telpon' => 'required|max:20',
        ]);

        Guru::create([
            'nip' => $request->nip,
            'nama' => $request->nama,
            'no_telepon' => $request->no_telpon,
        ]);

        return response()->json(['success' => true]);
    }

    public function edit($id)
    {
        $guru = Guru::findOrFail($id);
        return response()->json($guru);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'nip' => 'required|unique:gurus,nip,' . $id . '|max:255',
            'nama' => 'required|max:255',
            'no_telpon' => 'required|max:20',
        ]);

        $guru = Guru::findOrFail($id);
        $guru->update([
            'nip' => $request->nip,
            'nama' => $request->nama,
            'no_telepon' => $request->no_telpon,
        ]);

        return response()->json(['success' => true]);
    }

    public function destroy($id)
    {
        $guru = Guru::findOrFail($id);
        $guru->delete();

        return response()->json(['success' => true]);
    }
}

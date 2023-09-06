<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mapel;

class MapelController extends Controller
{
    public function index()
    {
        $mapels = Mapel::orderBy('id', 'asc')->get();
        return view('mapel.index', compact('mapels'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_mapel' => 'required|string|max:255',
        ]);

        Mapel::create([
            'nama_mapel' => $request->nama_mapel,
        ]);

        return response()->json(['success' => true]);
    }

    public function edit($id)
    {
        $mapel = Mapel::findOrFail($id);
        return response()->json($mapel);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_mapel' => 'required|string|max:255',
        ]);

        $mapel = Mapel::findOrFail($id);
        $mapel->update([
            'nama_mapel' => $request->nama_mapel,
        ]);

        return response()->json(['success' => true]);
    }

    public function destroy($id)
    {
        $mapel = Mapel::findOrFail($id);
        $mapel->delete();

        return response()->json(['success' => true]);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kinerja;

class KinerjaController extends Controller
{
    public function index()
    {
        $kinerjas = Kinerja::all();
        return view('kinerja.index', compact('kinerjas'));
    }

    public function show($id)
    {
        $kinerja = Kinerja::findOrFail($id);
        return response()->json(['kinerja' => $kinerja]);
    }

    public function create()
    {
        return response()->json(['success' => true]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kinerja' => 'required',
            'jenis_kinerja' => 'required|in:punishment,reward',
            'poin_kinerja' => 'required|integer',
        ]);

        $kinerja = Kinerja::create($request->all());
        return response()->json(['success' => true]);
    }

    public function edit($id)
    {
        $kinerja = Kinerja::findOrFail($id);
        return response()->json(['kinerja' => $kinerja]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_kinerja' => 'required',
            'jenis_kinerja' => 'required|in:punishment,reward',
            'poin_kinerja' => 'required|integer',
        ]);

        $kinerja = Kinerja::findOrFail($id);
        $kinerja->update($request->all());
        return response()->json(['success' => true]);
    }

    public function destroy($id)
    {
        Kinerja::destroy($id);
        return response()->json(['success' => true]);
    }
}

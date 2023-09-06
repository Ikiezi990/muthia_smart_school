<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jurusan;

class JurusanController extends Controller
{
    public function index()
    {
        $jurusans = Jurusan::all();
        return view('jurusan.index', compact('jurusans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_jurusan' => 'required',
        ]);

        Jurusan::create($request->all());
        return response()->json(['success' => true]);
    }

    public function edit($id)
    {
        $jurusan = Jurusan::findOrFail($id);
        return response()->json($jurusan);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_jurusan' => 'required',
        ]);

        $jurusan = Jurusan::findOrFail($id);
        $jurusan->update($request->all());
        return response()->json(['success' => true]);
    }

    public function destroy($id)
    {
        Jurusan::destroy($id);
        return response()->json(['success' => true]);
    }
}

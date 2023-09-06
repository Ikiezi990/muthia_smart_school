<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Angkatan;

class AngkatanController extends Controller
{
    public function index()
    {
        $angkatans = Angkatan::all();
        return view('angkatan.index', compact('angkatans'));
    }

    public function store(Request $request)
    {
        Angkatan::create($request->all());
        return response()->json(['success' => true]);
    }

    public function edit($id)
    {
        $angkatan = Angkatan::findOrFail($id);
        return response()->json($angkatan);
    }

    public function update(Request $request, $id)
    {
        $angkatan = Angkatan::findOrFail($id);
        $angkatan->update($request->all());
        return response()->json(['success' => true]);
    }

    public function destroy($id)
    {
        Angkatan::destroy($id);
        return response()->json(['success' => true]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Tagihan;
use Illuminate\Http\Request;

class TagihanController extends Controller
{
    public function index()
    {
        $tagihans = Tagihan::with('kelas')->get();
        $kelases = Kelas::all();
        return view('tagihan.index', compact('tagihans', 'kelases'));
    }

    public function store(Request $request)
    {
        Tagihan::create($request->all());
        return response()->json(['success' => true]);
    }

    public function edit($id)
    {
        $tagihan = Tagihan::findOrFail($id);
        return response()->json($tagihan);
    }

    public function update(Request $request, $id)
    {
        $tagihan = Tagihan::findOrFail($id);
        $tagihan->update($request->all());
        return response()->json(['success' => true]);
    }

    public function destroy($id)
    {
        Tagihan::destroy($id);
        return response()->json(['success' => true]);
    }
}

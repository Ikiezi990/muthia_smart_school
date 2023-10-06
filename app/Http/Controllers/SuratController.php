<?php

namespace App\Http\Controllers;

use App\Models\Surat;
use Illuminate\Http\Request;

class SuratController extends Controller
{
    public function index()
    {
        // Mengambil data Surat dari database
        if (auth()->user()->is_admin == "guru") {
            $surats = Surat::whereDate('created_at', date("Y-m-d"))->orderBy('created_at')->get();
            return view('surat.index', compact('surats'));
        } else {
            $siswa = \App\Models\siswa::where('nisn', auth()->user()->reference_id)->first();
            $surats = Surat::whereDate('created_at', date("Y-m-d"))->where("siswa_id", $siswa->id)->orderBy('created_at')->get();
            return view('surat.index', compact('surats'));
        }
    }

    public function store(Request $request)
    {
        // Validasi request
        $request->validate([
            'jenis_surat' => 'required',
            'tanggal_surat' => 'required',
            'lampiran' => 'file|mimes:pdf,png,jpg,jpeg,doc,docx|max:2048', // Sesuaikan dengan jenis file yang diperbolehkan
        ]);
        $siswa = \App\Models\siswa::where('nisn', auth()->user()->reference_id)->first();

        // Simpan data Surat baru ke database
        $surat = new Surat();
        $surat->jenis_surat = $request->jenis_surat;
        $surat->tanggal_surat = $request->tanggal_surat;
        $surat->siswa_id = $siswa->id;

        // Mengelola file lampiran
        if ($request->hasFile('lampiran')) {
            $file = $request->file('lampiran');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('lampiran'), $fileName);
            $surat->lampiran = $fileName;
        }

        $surat->save();

        return response()->json(['success' => true, 'message' => 'Surat berhasil ditambahkan']);
    }

    public function edit($id)
    {
        // Mengambil data Surat berdasarkan ID
        $surat = Surat::findOrFail($id);
        return response()->json($surat);
    }

    public function update(Request $request, $id)
    {
        // Validasi request
        $request->validate([
            'jenis_surat' => 'required',
            'tanggal_surat' => 'required',
            'lampiran' => 'file|mimes:pdf,png,jpg,jpeg,doc,docx|max:2048', // Sesuaikan dengan jenis file yang diperbolehkan
        ]);

        // Mengambil data Surat berdasarkan ID
        $surat = Surat::findOrFail($id);
        $siswa = \App\Models\siswa::where('nisn', auth()->user()->reference_id)->first();
        $surat->jenis_surat = $request->jenis_surat;
        $surat->tanggal_surat = $request->tanggal_surat;
        $surat->siswa_id = $siswa->id;

        // Mengelola file lampiran
        if ($request->hasFile('lampiran')) {
            $file = $request->file('lampiran');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('lampiran'), $fileName);

            // Hapus file lama jika ada
            if ($surat->lampiran) {
                unlink(public_path('lampiran/' . $surat->lampiran));
            }

            $surat->lampiran = $fileName;
        }

        $surat->save();

        return response()->json(['success' => true, 'message' => 'Surat berhasil diperbarui']);
    }

    public function destroy($id)
    {
        // Mengambil data Surat berdasarkan ID
        $surat = Surat::findOrFail($id);

        // Hapus file lampiran jika ada
        if ($surat->lampiran) {
            unlink(public_path('lampiran/' . $surat->lampiran));
        }

        // Hapus data Surat dari database
        $surat->delete();

        return response()->json(['success' => true, 'message' => 'Surat berhasil dihapus']);
    }
    public function download($id)
    {
        // Fetch the surat record from the database by its ID
        $surat = Surat::find($id);

        // Check if the surat exists
        if (!$surat) {
            abort(404); // Or handle the case where the surat doesn't exist
        }

        // Define the file path
        $filePath = public_path('lampiran/' . $surat->lampiran);

        // Check if the file exists
        if (!file_exists($filePath)) {
            abort(404); // Or handle the case where the file doesn't exist
        }

        // Generate the file name for download (you can customize this)
        $fileName = $surat->jenis_surat . '-' . $surat->tanggal_surat . '.pdf';

        // Set the appropriate headers for the file download
        header('Content-Type: application/pdf');
        header('Content-Disposition: attachment; filename="' . $fileName . '"');

        // Read and output the file contents
        readfile($filePath);

        // Redirect back to the home page using JavaScript
    }
}

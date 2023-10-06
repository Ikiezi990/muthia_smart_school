<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\Tagihan;
use App\Models\TransaksiTagihan;

class TransaksiController extends Controller
{
    public function index($siswaId)
    {
        $siswa = siswa::find($siswaId);
        $tagihan = Tagihan::where('siswa_id', $siswaId)->get();
        $transaksi = TransaksiTagihan::where('siswa_id', $siswaId)->get();

        return view('transaksi.index', compact('siswa', 'tagihan', 'transaksi'));
    }

    public function showKelas()
    {
        $kelas = Kelas::all();
        return view('transaksi.kelas', compact('kelas'));
    }

    public function showSiswa($kelasId)
    {
        $kelas = Kelas::find($kelasId);
        $siswa = siswa::where('kelas_id', $kelasId)->get();
        return view('transaksi.siswa', compact('kelas', 'siswa'));
    }

    public function showTagihan($siswaId)
    {
        $siswa = siswa::find($siswaId);
        $tagihan = TransaksiTagihan::with('tagihan')->where('siswa_id', $siswaId)->get()->groupBy('tagihan_id');
        return view('transaksi.tagihan', compact('siswa', 'tagihan'));
    }

    public function createTransaksi($siswaId)
    {
        $siswa = siswa::find($siswaId);
        $tagihan = Tagihan::where('kelas_id', $siswa->kelas_id)->get();

        return view('transaksi.create', compact('siswa', 'tagihan'));
    }

    public function storeTransaksi(Request $request)
    {


        // Simpan transaksi
        $transaksi = new TransaksiTagihan();
        $transaksi->siswa_id = $request->siswa_id;
        $transaksi->tagihan_id = $request->tagihan_id;
        $transaksi->tanggal_bayar = $request->tanggal_bayar;
        $transaksi->kelas_id = $request->kelas_id;
        $transaksi->nominal = $request->nominal;
        $transaksi->save();

        return redirect()->route('transaksi.tagihan', $request->siswa_id)->with('success', 'Transaksi berhasil disimpan.');
    }

    public function editTransaksi($transaksiId)
    {
        $transaksi = TransaksiTagihan::find($transaksiId);
        $siswa = siswa::find($transaksi->siswa_id);
        $tagihan = Tagihan::where('siswa_id', $transaksi->siswa_id)->get();

        return view('transaksi.edit', compact('siswa', 'tagihan', 'transaksi'));
    }

    public function updateTransaksi(Request $request, $transaksiId)
    {
        // Validasi input


        // Update transaksi
        $transaksi = TransaksiTagihan::find($transaksiId);
        $transaksi->siswa_id = $request->siswa_id;
        $transaksi->tagihan_id = $request->tagihan_id;
        $transaksi->tanggal_bayar = $request->tanggal_bayar;
        $transaksi->nominal = $request->nominal;
        $transaksi->save();

        return redirect()->route('transaksi.index', $request->siswa_id)->with('success', 'Transaksi berhasil diperbarui.');
    }

    public function destroyTransaksi($transaksiId)
    {
        $transaksi = TransaksiTagihan::find($transaksiId);
        $siswaId = $transaksi->siswa_id;
        $transaksi->delete();

        return redirect()->route('transaksi.index', $siswaId)->with('success', 'Transaksi berhasil dihapus.');
    }
}

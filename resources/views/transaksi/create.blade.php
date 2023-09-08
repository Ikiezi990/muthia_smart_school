@extends('templates.frontend')

@section('content')
<h1>Buat Transaksi Baru - {{ $siswa->nama_lengkap }}</h1>
<a href="{{ route('transaksi.siswa', $siswa->kelas_id) }}" class="btn btn-primary">Kembali ke Daftar Siswa</a>

<form method="POST" action="{{ route('transaksi.store') }}">
    @csrf
    <input type="hidden" name="siswa_id" value="{{ $siswa->id }}">
    <input type="hidden" name="kelas_id" value="{{ $siswa->kelas_id }}">
    <div class="form-group">
        <label for="tagihan_id">Tagihan</label>
        <select class="form-control" id="tagihan_id" name="tagihan_id" required>
            <option value="">Pilih Tagihan</option>
            @foreach ($tagihan as $item)
            <option value="{{ $item->id }}">{{ $item->nama_tagihan }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="tanggal_bayar">Tanggal Bayar</label>
        <input type="date" class="form-control" id="tanggal_bayar" name="tanggal_bayar" required>
    </div>
    <div class="form-group">
        <label for="nominal">Nominal</label>
        <input type="number" class="form-control" id="nominal" name="nominal" required>
    </div>
    <button type="submit" class="btn btn-success">Simpan</button>
</form>
@endsection
@extends('templates.frontend')

@section('content')
<div class="card card-style">
    <div class="content">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="mb-3">Daftar Tagihan - {{ $siswa->nama_lengkap }}</h2>
            <a href="{{ route('transaksi.siswa', $siswa->kelas_id) }}" class="btn btn-primary">Kembali ke Daftar Siswa</a>
        </div>
        <!-- Tambahkan tombol Create di sini -->
        <a href="{{ route('transaksi.create', $siswa->id) }}" class="btn btn-success mb-3"><i class="fa fa-plus"></i> Create Tagihan</a>
        <!-- Tampilkan daftar tagihan siswa dalam format list -->
        <ul class="list-unstyled">
            @foreach ($tagihan as $group)
            <li>
                <strong>Deskripsi:</strong> {{ $group[0]->tagihan->nama_tagihan }}
                <br>
                <strong>Total Nominal:</strong> {{ $group[0]->nominal }}
            </li>
            @endforeach
        </ul>
    </div>
</div>
@endsection
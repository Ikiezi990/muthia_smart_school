@extends('templates.frontend')

@section('content')
<div class="card card-style">
    <div class="content">
        <h2 class="mb-3">Daftar Siswa - {{ $kelas->nama_kelas }}</h2>
        <ul class="list-unstyled">
            @foreach ($siswa as $siswa)
            <li class="mb-3">
                <div class="card">
                    <div class="card-content">
                        <div class="card-title">
                            <h6 class="font-12 font-600 mb-1">{{ $siswa->nama_lengkap }}</h6>
                        </div>
                        <div class="card-footer">
                            <a href="{{ route('transaksi.tagihan', $siswa->id) }}" class="btn btn-primary">
                                Lihat Tagihan&nbsp; <i class="fa fa-list"></i>
                            </a>

                        </div>
                    </div>
                </div>
            </li>
            @endforeach
        </ul>
    </div>
</div>
@endsection
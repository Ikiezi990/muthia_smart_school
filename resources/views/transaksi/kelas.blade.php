@extends('templates.frontend')

@section('content')
<div class="card card-style">
    <div class="content">
        <h2 class="mb-3">Daftar Kelas</h2>
        <ul class="list-unstyled">
            @foreach ($kelas as $kelas)
            <li class="mb-3">
                <div class="card">
                    <div class="card-content">
                        <div class="card-title">
                            <h6 class="font-12 font-600 mb-1">{{ $kelas->nama_kelas }}</h6>
                        </div>
                        <div class="card-footer">
                            <a href="{{ route('transaksi.siswa', $kelas->id) }}" class="btn btn-info">
                                Lihat Siswa &nbsp;<i class="fa fa-list"></i>
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
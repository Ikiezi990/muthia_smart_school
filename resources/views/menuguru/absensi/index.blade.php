@extends('templates.frontend')

@section('content')
<div class="card card-style">
    <div class="content">
        <h2 class="mb-3">Daftar Jadwal Absensi</h2>
        <ul class="list-unstyled">
            @foreach ($jadwal as $jdwl)
            <li class="mb-3">
                <div class="card">
                    <div class="card-content">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="card-title">
                                <h6 class="font-12 font-600">{{ $jdwl->mapel->nama_mapel }}</h6>
                                <p class="opacity-60 font-10 mb-0">{{ $jdwl->kelas->nama_kelas }}</p>
                                <p class="opacity-60 font-10 mb-0">{{ $jdwl->hari }} | {{ $jdwl->jam }}</p>
                            </div>
                            <div class="card-footer">
                                <a href="{{ route('absensi.guru.detail', [$jdwl->kelas->id, $jdwl->id]) }}" class="btn btn-info">
                                    <i class="fa fa-list"></i> Absen
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </li>

            @endforeach
        </ul>
    </div>
</div>
@endsection
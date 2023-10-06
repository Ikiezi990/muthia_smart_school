@extends('templates.frontend')

@section('content')
@php
$siswa = \App\Models\siswa::where('nisn', auth()->user()->reference_id)->first();
$tabungans = \App\Models\Tabungan::where('siswa_id', $siswa->id)->orderBy('tanggal_menabung')->get();
$totalTabungan = \App\Models\Tabungan::where('siswa_id', $siswa->id)->sum('nominal');
@endphp
<div class="card card-style">
    <div class="content">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h6 class="mb-0">Tabungan Siswa - {{ $siswa->nama_lengkap }}</h6>
        </div>

        @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif

        <div class="card card-style mb-3">
            <div class="content">
                <h6>Total Tabungan</h6>
                <h2 class="font-700 text-center">Rp. {{ number_format($totalTabungan) }};</h2>
            </div>
        </div>


        <div class="scrollable">
            <h6>Riwayat Menabung</h6>
            <hr>
            <ul class="list-unstyled">
                @foreach ($tabungans as $tabungan)
                <li class="mb-3">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <h6 class="font-12 font-600 mb-1">Tanggal Menabung: {{ $tabungan->tanggal_menabung }}</h6>
                            <p class="opacity-60 font-10 mb-0">Nominal: Rp. {{ number_format($tabungan->nominal) }}</p>
                        </div>
                        <div>

                        </div>
                    </div>
                </li>
                @endforeach
            </ul>
        </div>

    </div>
</div>
@endsection
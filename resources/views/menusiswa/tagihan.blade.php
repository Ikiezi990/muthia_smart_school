@extends('templates.frontend')

@section('content')
<div class="card card-style">
    <div class="content">
        <h2 class="mb-3">Daftar Tagihan</h2>
        @php
        $siswa = \App\Models\siswa::where('nisn', auth()->user()->reference_id)->first();

        $transaksi = \App\Models\TransaksiTagihan::where('siswa_id', $siswa->id)->get();
        $tagihan = \App\Models\Tagihan::whereIn('id', $transaksi->pluck('tagihan_id'))->get();
        $tagihan = \App\Models\Tagihan::whereIn('id', $transaksi->pluck('tagihan_id'))->where('kelas_id', $siswa->kelas_id)->get();
        $tagihanBelumBayar = \App\Models\Tagihan::whereNotIn('id', $transaksi->pluck('tagihan_id'))->where('kelas_id', $siswa->kelas_id)->get();
        $tunggakan = \App\Models\Tagihan::whereNotIn('id', $transaksi->pluck('tagihan_id'))->where('kelas_id', $siswa->kelas_id)->sum("nominal");
        @endphp
        <ul class="list-unstyled">
            @foreach ($tagihan as $tgh)
            <li class="mb-3">
                <div class="card">
                    <div class="card-content">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="card-title">
                                <h6 class="font-12 font-600">Nama Tagihan: {{ $tgh->nama_tagihan }}</h6>
                                <p class="opacity-60 font-10 mb-0">Nominal Bayar : Rp. {{ $tgh->nominal }};</p>
                            </div>
                            <div class="card-footer bg-success">
                                <h6 class="font-12 font-600 text-white">Sudah lunas</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </li>


            @endforeach
            @foreach ($tagihanBelumBayar as $tghb)
            <li class="mb-3">
                <div class="card">
                    <div class="card-content">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="card-title">
                                <h6 class="font-12 font-600">Nama Tagihan: {{ $tghb->nama_tagihan }}</h6>
                                <p class="opacity-60 font-10 mb-0">Nominal Bayar : Rp. {{ $tghb->nominal }};</p>
                            </div>
                            <div class="card-footer bg-danger">
                                <h6 class="font-12 font-600 text-white">Belum lunas</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </li>
            @endforeach
            <li>
                <div class="card bg-secondary" style="padding: 20px;">
                    <div class="card-content ">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="card-title">
                                <h6 class="font-12 font-600 text-white">Total Tunggakan :</h6>

                            </div>
                            <div class="card-footer bg-danger">
                                <h6 class="font-12 font-600 text-white">Rp. {{ $tunggakan }};</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</div>
@endsection
@extends('templates.frontend')

@section('content')

<div class="card card-style">
    <div class="content">

        @if(Auth::user()->is_admin=="admin")
        <div class="row mx-auto mb-0 text-center" style="max-width:330px;">
            <h1 class="fa-2x font-900 mb-0 color-highlight col-12">MENU ADMIN</h1>
            <p class="font-13 col-12">Statistik</p>
            <div class="col-12">
                <div class="card card-style">
                    <div class="content text-center">
                        <h4>Total Pemasukan Hari Ini</h4>
                        @php
                        $tabungan = \App\Models\Tabungan::where('tanggal_menabung', date("Y-m-d"))->sum('nominal');

                        @endphp
                        <h4>Rp. {{ $tabungan }};</h4>
                    </div>
                </div>
            </div>

            <p class="font-13 col-12">DATA MASTER</p>

            <!-- Row 1 -->
            <div class="col-6">
                <a href="{{ route('guru.index') }}">
                    <i class="fa fa-users fa-2x mb-2" style="color: #39a1ff;"></i>
                    <p class="font-12">Guru</p>
                </a>
            </div>
            <div class="col-6">
                <a href="{{ route('siswa.index') }}">
                    <i class="fa fa-users fa-2x mb-2" style="color: #ff6b6b;"></i>
                    <p class="font-12">Siswa</p>
                </a>
            </div>

            <!-- Row 2 -->
            <div class="col-6">
                <a href="{{route('mapel.index')}}">
                    <i class="fa fa-book fa-2x mb-2" style="color: #ffa36b;"></i>
                    <p class="font-12">Mata Pelajaran</p>
                </a>
            </div>

            <!-- Row 3 -->
            <div class="col-6">
                <a href="{{ route('jurusan.index') }}">
                    <i class="fa fa-graduation-cap fa-2x mb-2" style="color: #53d769;"></i>
                    <p class="font-12">Jurusan</p>
                </a>
            </div>

            <!-- Row 4 -->
            <div class="col-6">
                <a href="{{ route('kelas.index') }}">
                    <i class="fa fa-building fa-2x mb-2" style="color: #39d6b6;"></i>
                    <p class="font-12">Kelas</p>
                </a>
            </div>
            <div class="col-6">
                <a href="{{ route('angkatan.index') }}">
                    <i class="fa fa-calendar-alt fa-2x mb-2" style="color: #ffbb6b;"></i>
                    <p class="font-12">Angkatan</p>
                </a>
            </div>
            <div class="col-6">
                <a href="{{ route('users.index') }}">
                    <i class="fa fa-users fa-2x mb-2" style="color: #ffbb6b;"></i>
                    <p class="font-12">User Management</p>
                </a>
            </div>
            <div class="col-6">
                <a href="{{ route('jadwal.index') }}">
                    <i class="fa fa-calendar fa-2x mb-2" style="color: #ffbb6b;"></i>
                    <p class="font-12">Jadwal</p>
                </a>
            </div>
        </div>
        <div class="row mx-auto mb-0 text-center" style="max-width:330px;">
            <p class="font-13 col-12">DATA TAGIHAN</p>

            <!-- Row 1 -->
            <div class="col-6">
                <a href="{{ route('tabungan.index') }}">
                    <i class="fa fa-book fa-2x mb-2" style="color: #39a1ff;"></i>
                    <p class="font-12">Tabungan Siswa</p>
                </a>
            </div>
            <div class="col-6">
                <a href="{{ url('tagihan') }}">
                    <i class="fa fa-dollar fa-2x mb-2" style="color: #ff6b6b;"></i>
                    <p class="font-12">Tagihan Siswa</p>
                </a>
            </div>
            <div class="col-6">
                <a href="{{ url('transaksi') }}">
                    <i class="fas fa-money-bill fa-2x mb-2" style="color: #aaaaaa;"></i>
                    <p class="font-12">Cashout Tabungan</p>
                </a>
            </div>
            <div class="col-6">
                <a href="{{ url('transaksi') }}">
                    <i class="fas fa-money-bill fa-2x mb-2" style="color: #ff6b6b;"></i>
                    <p class="font-12">Bayar Tagihan</p>
                </a>
            </div>


        </div>

        @endif
        @if(Auth::user()->is_admin=="siswa")
        <div class="row mx-auto mb-0 text-center" style="max-width:330px;">
            <p class="font-13 col-12">DATA KEUANGAN</p>

            <!-- Row 1 -->
            <div class="col-6">
                <a href="{{ route('tabungan.index') }}">
                    <i class="fa fa-book fa-2x mb-2" style="color: #39a1ff;"></i>
                    <p class="font-12">Tabungan Siswa</p>
                </a>
            </div>
            <div class="col-6">
                <a href="{{ url('tagihan') }}">
                    <i class="fa fa-dollar fa-2x mb-2" style="color: #ff6b6b;"></i>
                    <p class="font-12">Tagihan Siswa</p>
                </a>
            </div>

        </div>
        @else
        <div class="row mx-auto mb-0 text-center" style="max-width:330px;">
            <h1 class="fa-2x font-900 mb-0 color-highlight col-12">MENU GURU</h1>
            <div class="col-6 mt-3">
                <a href="{{ route('absensi.guru.index') }}">
                    <i class="fa fa-book fa-2x mb-2" style="color: #39a1ff;"></i>
                    <p class="font-12">Absensi Siswa</p>
                </a>
            </div>
            <div class="col-6 mt-3">
                <a href="{{ url('guru/absensi/siswa') }}">
                    <i class="fa fa-history fa-2x mb-2" style="color: #39a1ff;"></i>
                    <p class="font-12">Riwayat Absensi</p>
                </a>
            </div>
        </div>


        @endif

    </div>

</div>
<div class="row">
    @if(auth()->user()->is_admin =="guru")
    @php
    // Setel lokal bahasa menjadi bahasa Indonesia
    setlocale(LC_TIME, 'id_ID');

    // Daftar nama hari dalam bahasa Indonesia
    $hariIndonesia = [
    'Sunday' => 'Minggu',
    'Monday' => 'Senin',
    'Tuesday' => 'Selasa',
    'Wednesday' => 'Rabu',
    'Thursday' => 'Kamis',
    'Friday' => 'Jumat',
    'Saturday' => 'Sabtu',
    ];

    // Mendapatkan nama hari dalam bahasa Indonesia berdasarkan tanggal saat ini
    $hariIni = date('l'); // Menghasilkan nama hari dalam bahasa Inggris
    $hariIndonesiaIni = $hariIndonesia[$hariIni];
    $guru = \App\Models\Guru::where('nip', auth()->user()->reference_id)->first();
    $jadwal = \App\Models\Jadwal::where(['hari' => $hariIndonesiaIni, 'guru_id' => $guru->id])->get();
    @endphp
    <div class="col-md-12">
        <div class="card card-style">
            <div class="content text-center">
                <h4>Statistik Kehadiran Hari Ini</h4>
                <div class="row">
                    <div class="col-6">
                        <div class="card card-style">
                            <div class="content text-center">
                                <h5>Hadir</h5>
                                <h6>{{ \App\Models\Absensi::whereIn('jadwal_id', $jadwal->pluck('id'))->where(["tanggal_absensi" => date("Y-m-d"), "status" => "Hadir"])->count() }}</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="card card-style">
                            <div class="content text-center">
                                <h5>Sakit</h5>
                                <h6>{{ \App\Models\Absensi::whereIn('jadwal_id', $jadwal->pluck('id'))->where(["tanggal_absensi" => date("Y-m-d"), "status" => "Sakit"])->count() }}</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="card card-style">
                            <div class="content text-center">
                                <h5>Izin</h5>
                                <h6>{{ \App\Models\Absensi::whereIn('jadwal_id', $jadwal->pluck('id'))->where(["tanggal_absensi" => date("Y-m-d"), "status" => "Izin"])->count() }}</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="card card-style">
                            <div class="content text-center">
                                <h5>Alpa</h5>
                                <h6>{{ \App\Models\Absensi::whereIn('jadwal_id', $jadwal->pluck('id'))->where(["tanggal_absensi" => date("Y-m-d"), "status" => "Alpa"])->count() }}</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12">
        <div class="card card-style">
            <div class="content text-center">
                @php
                // Setel lokal bahasa menjadi bahasa Indonesia
                setlocale(LC_TIME, 'id_ID');

                // Daftar nama hari dalam bahasa Indonesia
                $hariIndonesia = [
                'Sunday' => 'Minggu',
                'Monday' => 'Senin',
                'Tuesday' => 'Selasa',
                'Wednesday' => 'Rabu',
                'Thursday' => 'Kamis',
                'Friday' => 'Jumat',
                'Saturday' => 'Sabtu',
                ];

                // Mendapatkan nama hari dalam bahasa Indonesia berdasarkan tanggal saat ini
                $hariIni = date('l'); // Menghasilkan nama hari dalam bahasa Inggris
                $hariIndonesiaIni = $hariIndonesia[$hariIni];
                $guru = \App\Models\Guru::where('nip', auth()->user()->reference_id)->first();
                $jadwal = \App\Models\Jadwal::where(['hari' => $hariIndonesiaIni, 'guru_id' => $guru->id])->get();
                @endphp

                <h4>Jadwal Mengajar Hari Ini</h4>

                @if ($jadwal->count() > 0)
                <table class="table">
                    <thead>
                        <tr>
                            <th>Waktu</th>
                            <th>Kelas</th>
                            <th>Mata Pelajaran</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($jadwal as $item)
                        <tr>
                            <td>{{ $item->jam }}</td>
                            <td>{{ $item->kelas->nama_kelas }}</td>
                            <td>{{ $item->mapel->nama_mapel }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @else
                <p>Tidak ada jadwal mengajar hari ini.</p>
                @endif

            </div>
        </div>
    </div>
    @endif
</div>
<!-- <div class="card card-style mb-5">
    <div class="content">
        <p class="font-13 col-12">DASHBOARD KEHADIRAN HARI INI</p>
        <div class="d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center">
                <i class="fa fa-calendar-check text-success mr-2 font-16"></i>
                <div>
                    <h6 class="font-14 font-600 mb-1">Total Siswa Hadir</h6>
                    <p class="opacity-60 font-10 mb-0">Jumlah siswa yang hadir hari ini.</p>
                </div>
            </div>
            <div>
                <h3 class="font-16 font-700">120</h3>
            </div>
        </div>
        <div class="divider mt-2 mb-2"></div>
        <div class="d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center">
                <i class="fa fa-calendar-times text-danger mr-2 font-16"></i>
                <div>
                    <h6 class="font-14 font-600 mb-1">Total Siswa Absen</h6>
                    <p class="opacity-60 font-10 mb-0">Jumlah siswa yang absen hari ini.</p>
                </div>
            </div>
            <div>
                <h3 class="font-16 font-700">15</h3>
            </div>
        </div>
        <div class="divider mt-2 mb-2"></div>
        <div class="d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center">
                <i class="fa fa-info-circle text-warning mr-2 font-16"></i>
                <div>
                    <h6 class="font-14 font-600 mb-1">Total Siswa Izin</h6>
                    <p class="opacity-60 font-10 mb-0">Jumlah siswa yang izin hari ini.</p>
                </div>
            </div>
            <div>
                <h3 class="font-16 font-700">5</h3>
            </div>
        </div>
        <div class="divider mt-2 mb-2"></div>
        <div class="d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center">
                <i class="fa fa-bed text-info mr-2 font-16"></i>
                <div>
                    <h6 class="font-14 font-600 mb-1">Total Siswa Sakit</h6>
                    <p class="opacity-60 font-10 mb-0">Jumlah siswa yang sakit hari ini.</p>
                </div>
            </div>
            <div>
                <h3 class="font-16 font-700">8</h3>
            </div>
        </div>
    </div>
</div> -->
<!-- <div class="card card-style mb-5">
    <div class="content">
        <p class="font-13 col-12">INFORMASI</p>
        <ul class="list-unstyled">
            @for ($i = 1; $i <= 3; $i++) <li class="mb-3">
                <div class="d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-bullhorn text-primary mr-2 font-16"></i>
                        <div>
                            <h6 class="font-14 font-600 mb-1">Pengumuman {{ $i }}</h6>
                            <p class="opacity-60 font-10 mb-0">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                        </div>
                    </div>
                    <a href="#" class="text-highlight font-12">Lihat Pengumuman</a>
                </div>
                </li>
                @endfor
        </ul>
    </div>
</div> -->

<!-- Tambahkan elemen di bawah ini -->

@endsection
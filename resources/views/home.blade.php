@extends('templates.frontend')

@section('content')


<div class="card card-style">
    <div class="content">

        @if(Auth::user()->is_admin=="admin")
        <div class="row mx-auto mb-0 text-center" style="max-width:330px;">
            <h1 class="fa-2x font-900 mb-0 color-highlight col-12">MENU ADMIN</h1>
            <p class="font-13 col-12">DATA MASTER</p>
            <!-- Row 1 -->
            <div class="col-6">
                <a href="{{ route('guru.index') }}">
                    <i class="fa fa-chalkboard-teacher fa-2x mb-2" style="color: #39a1ff;"></i>
                    <p class="font-12">Guru</p>
                </a>
            </div>
            <div class="col-6">
                <a href="{{ route('siswa.index') }}">
                    <i class="fa fa-user-graduate fa-2x mb-2" style="color: #ff6b6b;"></i>
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
                    <i class="fa fa-school fa-2x mb-2" style="color: #39d6b6;"></i>
                    <p class="font-12">Kelas</p>
                </a>
            </div>
            <div class="col-6">
                <a href="{{ route('angkatan.index') }}">
                    <i class="fa fa-calendar fa-2x mb-2" style="color: #ffbb6b;"></i>
                    <p class="font-12">Angkatan</p>
                </a>
            </div>
            <div class="col-6">
                <a href="{{ route('users.index') }}">
                    <i class="fa fa-user-cog fa-2x mb-2" style="color: #ffbb6b;"></i>
                    <p class="font-12">User Management</p>
                </a>
            </div>
            <div class="col-6">
                <a href="{{ route('jadwal.index') }}">
                    <i class="fa fa-calendar-alt fa-2x mb-2" style="color: #ffbb6b;"></i>
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
        <div class="row mx-auto mb-0 text-center" style="max-width:330px;">
            <p class="font-13 col-12">DATA KINERJA</p>

            <!-- Row 1 -->
            <div class="col-6">
                <a href="{{ url('/kinerja') }}">
                    <i class="fa fa-book fa-2x mb-2" style="color: #39a1ff;"></i>
                    <p class="font-12">Kinerja</p>
                </a>
            </div>
            <div class="col-6">
                <a href="{{ url('/kinerja-siswa') }}" target="_blank">
                    <i class="fa fa-dollar fa-2x mb-2" style="color: #ff6b6b;"></i>
                    <p class="font-12">List Kinerja</p>
                </a>
            </div>

        </div>

        @endif
        @if(Auth::user()->is_admin=="siswa")
        <div class="row mx-auto mb-0 text-center" style="max-width:330px;">
            <h5 class="fa-1x font-900 mb-0 color-highlight col-12">MENU SISWA</h5>

            <!-- Row 1 -->
            <div class="col-6 mt-3">
                <a href="{{ route('absensi.tanggal.siswa') }}">
                    <i class="fas fa-user-check fa-2x mb-2" style="color: #39a1ff;"></i>
                    <p class="font-12">Absensi Siswa</p>
                </a>
            </div>
            <div class="col-6 mt-3">
                <a href="{{ url('/tabungansiswa') }}">
                    <i class="fas fa-dollar-sign fa-2x mb-2" style="color: #ff6b6b;"></i>
                    <p class="font-12">Tabungan Siswa</p>
                </a>
            </div>
            <div class="col-6 mt-3">
                <a href="{{ url('tagihan-siswa') }}">
                    <i class="fas fa-file-invoice-dollar fa-2x mb-2" style="color: #ff6b6b;"></i>
                    <p class="font-12">Tagihan Siswa</p>
                </a>
            </div>

        </div>

        @elseif(auth()->user()->is_admin == "guru")
        <div class="row mx-auto mb-0 text-center" style="max-width:330px;">
            <h4 class="fa-2x font-900 mb-0 color-highlight col-12">MENU GURU</h4>
            <div class="col-6 mt-3">
                <a href="{{ route('absensi.guru.index') }}">
                    <i class="fa fa-users fa-2x mb-2" style="color: #39a1ff;"></i>
                    <p class="font-10">Absensi Siswa</p>
                </a>
            </div>
            <div class="col-6 mt-3">
                <a href="{{ route('absensi.tanggal') }}">
                    <i class="fa fa-clock fa-2x mb-2" style="color: #39a1ff;"></i>
                    <p class="font-10">Riwayat Absensi</p>
                </a>
            </div>
            <div class="col-6">
                <a href="{{ url('/kinerja-siswa') }}" target="_blank">
                    <i class="fa fa-chart-bar fa-2x mb-2" style="color: #ff6b6b;"></i>
                    <p class="font-12">Data Kinerja</p>
                </a>
            </div>

            <div class="col-6">
                <a href="{{ url('surat') }}">
                    <i class="fas fa-envelope fa-2x mb-2" style="color: #39a1ff;"></i>
                    <p class="font-12">Surat</p>
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
                <h6>Statistik Kehadiran Hari Ini</h6>
                <div class="row">
                    <div class="col-6">
                        <div class="card card-style bg-success">
                            <div class="content text-center">
                                <h6 class="text-white">Hadir</h6>
                                <h6 class="text-white">{{ \App\Models\Absensi::whereIn('jadwal_id', $jadwal->pluck('id'))->where(["tanggal_absensi" => date("Y-m-d"), "status" => "Hadir"])->count() }}</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="card card-style bg-warning">
                            <div class="content text-center text-white">
                                <h6 class="text-center text-white">Sakit</h6>
                                <h6 class="text-center text-white">{{ \App\Models\Absensi::whereIn('jadwal_id', $jadwal->pluck('id'))->where(["tanggal_absensi" => date("Y-m-d"), "status" => "Sakit"])->count() }}</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="card card-style bg-info">
                            <div class="content text-center">
                                <h6 class="text-white">Izin</h6>
                                <h6 class="text-white">{{ \App\Models\Absensi::whereIn('jadwal_id', $jadwal->pluck('id'))->where(["tanggal_absensi" => date("Y-m-d"), "status" => "Izin"])->count() }}</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="card card-style bg-danger">
                            <div class="content text-center ">
                                <h6 class="text-white">Alpa</h6>
                                <h6 class="text-white">{{ \App\Models\Absensi::whereIn('jadwal_id', $jadwal->pluck('id'))->where(["tanggal_absensi" => date("Y-m-d"), "status" => "Alpa"])->count() }}</h6>
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
                <table class="table table-bordered">
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

    @elseif(auth()->user()->is_admin == "siswa")
    <div class="col-12">
        <div class="card card-style">
            <div class="content text-center">
                @php
                $siswa = \App\Models\siswa::where('nisn', auth()->user()->reference_id)->first();

                // Query untuk statistik kinerja per bulan
                $bulanIni = now()->format('Y-m');
                $totalPelanggaran = \App\Models\KinerjaSiswa::where('siswa_id', $siswa->id)
                ->whereHas('kinerja', function ($query) {
                $query->where('jenis_kinerja', 'punishment');
                })
                ->whereDate('created_at', 'like', $bulanIni . '%')
                ->sum('poin');

                $totalPenghargaan = \App\Models\KinerjaSiswa::where('siswa_id', $siswa->id)
                ->whereHas('kinerja', function ($query) {
                $query->where('jenis_kinerja', 'reward');
                })
                ->whereDate('created_at', 'like', $bulanIni . '%')
                ->sum('poin');


                $kinerjasiswa = \App\Models\KinerjaSiswa::whereDate('created_at' , date('Y-m-d'))
                ->where('siswa_id', $siswa->id)
                ->get();
                @endphp

                <h6>Catatan Kinerja Perbulan ({{date('M')}})</h6>
                <hr>

                <!-- Card total pelanggaran -->
                <div class="row">
                    <div class="col-6">
                        <div class="card mb-3">
                            <div class="card-body bg-danger">
                                <h5 class="card-title text-white">Total Pelanggaran Bulan Ini</h5>
                                <p class="card-text text-white">{{ $totalPelanggaran }} Poin</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="card">
                            <div class="card-body bg-success">
                                <h5 class="card-title text-white">Total Penghargaan Bulan Ini</h5>
                                <p class="card-text text-white">{{ $totalPenghargaan }} Poin</p>
                            </div>
                        </div>
                    </div>
                </div>

                <hr>
                <!-- Card total penghargaan -->

                <h6>Riwayat Kinerja</h6>
                <hr>
                @if ($kinerjasiswa->count() > 0)
                <!-- Riwayat kinerja -->
                <ul class="list-unstyled ">
                    @foreach ($kinerjasiswa as $item)
                    @if($item->kinerja->jenis_kinerja == "punishment")
                    <li class="mb-3 bg-danger" style="padding: 5px;">
                        <!-- Tampilkan informasi kinerja -->
                        <div class="d-flex align-items-center justify-content-between">
                            <div style="display: block;">
                                <h1 class="font-14 font-600 mb-1 text-white" style="text-transform: uppercase;">{{ $item->kinerja->nama_kinerja }}</h1>
                                <p class="font-10 text-white">Jam & Tanggal : {{ $item->created_at }}</p>
                            </div>
                            <div style="display: block;">
                                <h4><span class="badge bg-danger text-white">Pelanggaran : {{ $item->poin }} Poin</span></h4>
                            </div>
                        </div>
                    </li>
                    @else
                    <li class="mb-3">
                        <!-- Tampilkan informasi kinerja -->
                        <div class="d-flex align-items-center justify-content-between">
                            <div style="display: block;">
                                <h1 class="font-10 font-600 mb-1 text-white" style="text-transform: uppercase;">{{ $item->kinerja->nama_kinerja }}</h1>
                                <p class="font-10 text-white">Jam & Tanggal : {{ $item->created_at }}</p>
                            </div>
                            <div style="display: block;">
                                <h4><span class="badge bg-primary text-white">Penghargaan : {{ $item->poin }} Poin</span></h4>
                            </div>
                        </div>
                    </li>
                    @endif
                    @endforeach
                </ul>
                @else
                <p>Tidak ada Catatan Kinerja Untuk Anda !.</p>
                @endif

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
                $siswa = \App\Models\siswa::where('nisn', auth()->user()->reference_id)->first();
                $jadwal = \App\Models\Jadwal::where(['hari' => $hariIndonesiaIni, 'kelas_id' => $siswa->kelas_id])->get();
                @endphp

                <h6>Jadwal Pelajaran Hari Ini</h6>
                <hr>

                @if ($jadwal->count() > 0)
                <table class="table">
                    <thead>
                        <tr>
                            <th class="bg-dark text-white">Waktu</th>
                            <th class="bg-dark text-white">Kelas</th>
                            <th class="bg-dark text-white">Mata Pelajaran</th>
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
                <p>Tidak ada jam pelajaran hari ini.</p>
                @endif

            </div>
        </div>
    </div>
    <div class="col-12">
        <div class="card card-style">
            <div class="content text-center">
                @php

                $siswa = \App\Models\siswa::where('nisn', auth()->user()->reference_id)->first();
                $kinerjasiswa = \App\Models\KinerjaSiswa::whereDate('created_at' , date('Y-m-d'))->where('siswa_id', $siswa->id)->get();
                @endphp

                <h6>Catatan Kinerja Hari Ini</h6>
                <hr>

                @if ($kinerjasiswa->count() > 0)
                <ul class="list-unstyled ">
                    @foreach ($kinerjasiswa as $item)
                    @if($item->kinerja->jenis_kinerja == "punishment")
                    <li class="mb-3 bg-danger" style="padding: 5px;">
                        <div class="d-flex align-items-center justify-content-between">
                            <div style="display: block;">
                                <h1 class="font-14 font-600 mb-1 text-white" style="text-transform: uppercase;">{{ $item->kinerja->nama_kinerja }}</h1>
                                <p class="font-10 text-white">Jam & Tanggal : {{ $item->created_at }}</p>
                            </div>
                            <div style="display: block;">

                                <h4><span class="badge bg-danger text-white">Pelanggaran : {{ $item->poin }} Poin</span></h4>



                            </div>
                        </div>
                    </li>
                    @else
                    <li class="mb-3">
                        <div class="d-flex align-items-center justify-content-between">
                            <div style="display: block;">
                                <h1 class="font-10 font-600 mb-1 text-white" style="text-transform: uppercase;">{{ $item->kinerja->nama_kinerja }}</h1>
                                <p class="font-10 text-white">Jam & Tanggal : {{ $item->created_at }}</p>

                            </div>
                            <div style="display: block;">


                                <h4><span class="badge bg-primary text-white">Penghargaan : {{ $item->poin }} Poin</span></h4>


                            </div>
                        </div>
                    </li>
                    @endif
                    @endforeach
                </ul>
                @else
                <p>Tidak ada Catatan Kinerja Untuk Anda !.</p>
                @endif

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
                $siswa = \App\Models\siswa::where('nisn', auth()->user()->reference_id)->first();
                $absensi = \App\Models\Absensi::where(['tanggal_absensi' => date("Y-m-d"), 'siswa_id' => $siswa->id])->get();
                @endphp

                <h6 class="">Riwayat Absensi Hari Ini ({{ $hariIndonesiaIni }})</h6>
                <hr>

                @if ($absensi->count() > 0)
                <ul class="list-unstyled">
                    @foreach ($absensi as $item)
                    @php
                    $mapel = \App\Models\Mapel::where("id", $item->jadwal->mapel_id)->first();
                    $guru = \App\Models\Guru::where("id", $item->jadwal->guru_id)->first();
                    @endphp
                    <li class="mb-3">
                        <div class="card card-style bg-secondary">
                            <div class="card-content" style="padding: 10px;">

                                <h6 class="font-14 font-600 mb-1 ">{{ $mapel->nama_mapel }}</h6>
                                <p class="opacity-100 font-10 mb-0 ">Nama Guru: {{ $guru->nama }}</p>
                                <p class="opacity-100 font-10 mb-0 ">Jam Pelajaran: {{ $item->jadwal->jam }}</p>
                                @if($item->status == "Hadir")
                                <p class="opacity-100 font-10 mb-0 text-white badge bg-success">Status: {{ $item->status }}</p>
                                @elseif($item->status == "Sakit")
                                <p class="opacity-100 font-10 mb-0 text-white badge bg-warning">Status: {{ $item->status }}</p>
                                @elseif($item->status == "Alpa")
                                <p class="opacity-100 font-10 mb-0 text-white badge bg-danger">Status: {{ $item->status }}</p>
                                @elseif($item->status == "Izin")
                                <p class="opacity-100 font-10 mb-0 text-white badge bg-info">Status: {{ $item->status }}</p>
                                @endif


                            </div>
                        </div>
                    </li>
                    @endforeach
                </ul>
                @else
                <p>Belum ada absen hari ini.</p>
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
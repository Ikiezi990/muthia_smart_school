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
        @endif
    </div>

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

<div class="card card-style mb-5">
    <div class="content">
        <p class="font-13 col-12">KELAS DAN ANGKATAN</p>
        <ul class="list-unstyled">
            <li class="mb-3">
                <div class="d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center">
                        <i class="fa fa-building text-info mr-2 font-16"></i>
                        <div>
                            <h6 class="font-14 font-600 mb-1">Kelas</h6>
                            <p class="opacity-60 font-10 mb-0">Daftar kelas yang tersedia.</p>
                        </div>
                    </div>
                    <a href="#" class="text-highlight font-12">Lihat Kelas</a>
                </div>
            </li>
            <li class="mb-3">
                <div class="d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center">
                        <i class="fa fa-flag text-warning mr-2 font-16"></i>
                        <div>
                            <h6 class="font-14 font-600 mb-1">Angkatan</h6>
                            <p class="opacity-60 font-10 mb-0">Daftar angkatan siswa.</p>
                        </div>
                    </div>
                    <a href="#" class="text-highlight font-12">Lihat Angkatan</a>
                </div>
            </li>
        </ul>
    </div>
</div>
@endsection
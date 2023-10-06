@extends('templates.frontend')
@section('content')
@if(auth()->user()->is_admin == "guru")
@php
$guru = \App\Models\Guru::where('nip', auth()->user()->reference_id)->first();
@endphp
<div class="card card-style">
    <div class="content">
        <div class="d-flex">
            <div>
                <img src="{{asset('templates/images/avatars/5s.png')}}" width="50" class="mr-3 bg-highlight rounded-xl">
            </div>
            <div>
                <h1 class="mb-0 pt-1">{{ $guru->nama }}</h1>
                <p class="color-highlight font-11 mt-n2 mb-3">GURU</p>
            </div>
        </div>
    </div>
</div>

<div class="card card-style">
    <div class="content mb-0">
        <div class="input-style input-style-2 input-required mb-4">
            <span class="color-highlight input-style-1-active">NUPTK</span>
            <input class="form-control" type="text" value="{{ $guru->nip }}" readonly>
        </div>

        <div class="input-style input-style-2 input-required mb-">
            <span class="color-highlight input-style-1-active">No Telpon</span>
            <input class="form-control" type="text" value="{{ $guru->no_telepon }}" readonly>
        </div>
    </div>
</div>
<div class="card card-style">
    <div class="content">


        <form id="logout-form" action="{{ route('logout') }}" method="POST">
            @csrf
            <button class="btn btn-danger btn-block">Logout</button>
        </form>
    </div>
</div>
@endif
@if(auth()->user()->is_admin == "siswa")
@php
$siswa = \App\Models\siswa::where('nisn', auth()->user()->reference_id)->first();
@endphp
<div class="card card-style">
    <div class="content">
        <div class="d-flex">
            <div>
                <img src="{{asset('templates/images/avatars/5s.png')}}" width="50" class="mr-3 bg-highlight rounded-xl">
            </div>
            <div>
                <h1 class="mb-0 pt-1">{{ $siswa->nama_lengkap }}</h1>
                <p class="color-highlight font-11 mt-n2 mb-3">SISWA</p>
            </div>
        </div>
    </div>
</div>

<div class="card card-style">
    <div class="content mb-0">
        <div class="input-style input-style-2 input-required mb-4">
            <span class="color-highlight input-style-1-active">NISN</span>
            <input class="form-control" type="text" value="{{ $siswa->nisn }}" readonly>
        </div>
        <div class="input-style input-style-2 input-required mb-4">
            <span class="color-highlight input-style-1-active">Kelas</span>
            <input class="form-control" type="text" value="{{ $siswa->kelas->nama_kelas }}" readonly>
        </div>

        <div class="input-style input-style-2 input-required mb-">
            <span class="color-highlight input-style-1-active">Jenis Kelamin</span>
            <input class="form-control" type="text" value="{{ $siswa->jenis_kelamin }}" readonly>
        </div>
        <div class="input-style input-style-2 input-required mb-">
            <span class="color-highlight input-style-1-active">Tempat & Tanggal Lahir</span>
            <input class="form-control" type="text" value="{{ $siswa->tempat_lahir }},{{ $siswa->tanggal_lahir }}" readonly>
        </div>
        <div class="input-style input-style-2 input-required mb-">
            <span class="color-highlight input-style-1-active">Alamat</span>
            <input class="form-control" type="text" value="{{ $siswa->alamat }}" readonly>
        </div>
    </div>
</div>
<div class="card card-style">
    <div class="content">


        <form id="logout-form" action="{{ route('logout') }}" method="POST">
            @csrf
            <button class="btn btn-danger btn-block">Logout</button>
        </form>
    </div>
</div>
@endif
@if(auth()->user()->is_admin == "admin")

<div class="card card-style">
    <div class="content">
        <div class="d-flex">
            <div>
                <img src="{{asset('templates/images/avatars/5s.png')}}" width="50" class="mr-3 bg-highlight rounded-xl">
            </div>
            <div>
                <h4 class="mb-0 pt-1">{{ auth()->user()->name }}</h4>
                <p class="color-highlight font-11 mt-n2 mb-3">Admin</p>
            </div>
        </div>
    </div>
</div>

<div class="card card-style">
    <div class="content mb-0">
        <div class="input-style input-style-2 input-required mb-4">
            <span class="color-highlight input-style-1-active">Email</span>
            <input class="form-control" type="text" value="{{ auth()->user()->email }}" readonly>
        </div>
    </div>
</div>
<div class="card card-style">
    <div class="content">


        <form id="logout-form" action="{{ route('logout') }}" method="POST">
            @csrf
            <button class="btn btn-danger btn-block">Logout</button>
        </form>
    </div>
</div>
@endif
@endsection
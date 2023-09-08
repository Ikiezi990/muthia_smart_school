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
@endsection
@extends('templates.frontend')

@section('content')
<div class="card card-style">
    <div class="content">
        <h6 class="mb-3">Tambah Tabungan Siswa - {{ $siswa->nama_lengkap }}</h6>
        <form action="{{ route('tabungan.store') }}" method="post">
            @csrf
            <input type="hidden" name="siswa_id" value="{{ $siswa->id }}">
            <div class="form-group">
                <label for="tanggal_menabung">Tanggal Menabung:</label>
                <input type="date" class="form-control" id="tanggal_menabung" name="tanggal_menabung" required>
            </div>
            <div class="form-group">
                <label for="nominal">Nominal:</label>
                <input type="number" class="form-control" id="nominal" name="nominal" required>
            </div>
            <button type="submit" class="btn btn-success">Tambah Tabungan</button>
        </form>
    </div>
</div>
@endsection
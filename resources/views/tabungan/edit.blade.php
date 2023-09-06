@extends('templates.frontend')

@section('content')
<div class="card card-style">
    <div class="content">
        <h6>Edit Tabungan</h6>
        <form action="{{ route('tabungan.update', $tabungan->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="tanggal_menabung">Tanggal Menabung:</label>
                <input type="date" class="form-control" name="tanggal_menabung" value="{{ $tabungan->tanggal_menabung }}">
            </div>
            <div class="form-group">
                <label for="nominal">Nominal:</label>
                <input type="number" class="form-control" name="nominal" value="{{ $tabungan->nominal }}">
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('tabungan.show', $tabungan->siswa_id) }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>
@endsection
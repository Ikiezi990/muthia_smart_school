@extends('templates.frontend')

@section('content')
<div class="card card-style">
    <div class="content">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="mb-3">Absensi</h2>
        </div>
        @if (isset($siswa) && count($siswa) > 0)
        <form method="POST" action="{{ route('absensi.storeBulk', [$siswa[0]->kelas_id, $jadwal_id]) }}">
            @csrf
            <input type="hidden" name="jadwal_id" value="{{ $jadwal_id }}">
            <ul class="list-unstyled">
                @foreach ($siswa as $siswaItem)
                <li>
                    <div class="d-flex justify-content-between">
                        <div>
                            <h6 class="font-12 font-600">{{ $siswaItem->nama_lengkap }}</h6>
                            <p>NIS: {{ $siswaItem->nisn }}</p>
                        </div>
                        <div>
                            <select class="form-control" name="absensi[{{ $siswaItem->id }}]">
                                <option value="Hadir">Hadir</option>
                                <option value="Sakit">Sakit</option>
                                <option value="Izin">Izin</option>
                                <option value="Alpa">Alpa</option>
                            </select>
                        </div>
                    </div>
                </li>
                @endforeach
            </ul>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
        @else
        <p>Semua siswa telah melakukan absensi.</p>
        @endif
    </div>
</div>
@endsection
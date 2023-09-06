@extends('templates.frontend')

@section('content')
<div class="card card-style">
    <div class="content">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2 class="mb-0">List Tabungan Siswa</h2>
            <div class="d-flex align-items-center">
            </div>
        </div>

        <div class="mb-3">
            <label for="search">Cari Siswa:</label>
            <input type="text" id="search" class="form-control" placeholder="Nama Siswa">
        </div>

        <ul class="list-unstyled" id="siswaList">
            @foreach ($siswas as $siswa)
            <li class="mb-3">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <h6 class="font-12 font-600 mb-1">{{ $siswa->nama_lengkap }}</h6>
                        <p class="opacity-60 font-10 mb-0">NIS: {{ $siswa->nisn }}</p>
                    </div>
                    <div>
                        <a href="{{ route('tabungan.show', $siswa->id) }}" class="btn btn-info"><i class="fa fa-eye"></i></a>
                    </div>
                </div>
            </li>
            @endforeach
        </ul>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#search').on('keyup', function() {
            var input = $(this).val().toLowerCase();
            $('#siswaList li').filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(input) > -1);
            });
        });
    });
</script>

@endsection
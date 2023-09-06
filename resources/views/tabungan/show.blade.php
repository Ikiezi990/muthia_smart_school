<!-- Include the SweetAlert CSS and JS -->
<link rel="stylesheet" href="{{ asset('path-to-sweetalert2/sweetalert2.min.css') }}">
<script src="{{ asset('path-to-sweetalert2/sweetalert2.min.js') }}"></script>

@extends('templates.frontend')

@section('content')
<div class="card card-style">
    <div class="content">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h6 class="mb-0">Tabungan Siswa - {{ $siswa->nama_lengkap }}</h6>
            <a href="{{ route('tabungan.create', ['siswa_id' => $siswa->id]) }}" class="btn btn-primary"><i class="fa fa-plus"></i></a>
        </div>

        @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif

        <div class="card card-style mb-3">
            <div class="content">
                <h6>Total Tabungan</h6>
                <h2 class="font-700 text-center">Rp. {{ number_format($totalTabungan) }};</h2>
            </div>
        </div>

        <div class="scrollable">
            <ul class="list-unstyled">
                @foreach ($tabungans as $tabungan)
                <li class="mb-3">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <h6 class="font-12 font-600 mb-1">Tanggal Menabung: {{ $tabungan->tanggal_menabung }}</h6>
                            <p class="opacity-60 font-10 mb-0">Nominal: Rp. {{ number_format($tabungan->nominal) }}</p>
                        </div>
                        <div>
                            <a href="{{ route('tabungan.edit', $tabungan->id) }}" class="btn btn-info edit-tabungan" data-id="{{ $tabungan->id }}">
                                <i class="fa fa-edit"></i>
                            </a>
                            <button class="btn btn-danger delete-tabungan" data-id="{{ $tabungan->id }}">
                                <i class="fa fa-trash"></i>
                            </button>
                        </div>
                    </div>
                </li>
                @endforeach
            </ul>
        </div>

    </div>
</div>

<script>
    document.querySelectorAll('.delete-tabungan').forEach(function(button) {
        button.addEventListener('click', function() {
            const tabunganId = this.getAttribute('data-id');

            Swal.fire({
                title: 'Are you sure?',
                text: 'You will not be able to recover this tabungan record!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    const form = document.querySelector(`form[data-id="${tabunganId}"]`);
                    form.submit();
                }
            });
        });
    });
</script>
@endsection
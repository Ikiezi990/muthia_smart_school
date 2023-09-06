@extends('templates.frontend')

@section('content')
<div class="card card-style">
    <div class="content">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2 class="mb-0">Data Angkatan</h2>
            <div class="d-flex align-items-center">
                <button id="addAngkatan" class="btn btn-primary ml-2"><i class="fa fa-plus"></i></button>
                <button id="refreshAngkatan" class="btn btn-secondary ml-2"><i class="fa fa-refresh"></i></button>
            </div>
        </div>
        <input type="text" id="searchInput" class="form-control" placeholder="Cari Tahun Angkatan">

        <ul id="angkatanList" class="list-unstyled">
            @foreach ($angkatans as $angkatan)
            <li class="mb-3">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <h6 class="font-14 font-600 mb-1">Tahun Angkatan: {{ $angkatan->tahun_angkatan }}</h6>
                        <p class="opacity-60 font-10 mb-0">ID: {{ $angkatan->id }}</p>
                    </div>
                    <div>
                        <button class="btn btn-info edit" data-id="{{ $angkatan->id }}">
                            <i class="fa fa-edit"></i>
                        </button>
                        <button class="btn btn-danger delete" data-id="{{ $angkatan->id }}">
                            <i class="fa fa-trash"></i>
                        </button>
                    </div>
                </div>
            </li>
            @endforeach
        </ul>
    </div>
</div>
<div class="container">
    <div id="myModal" class="modal" style="padding: 5px;">
        <div class="modal-content" style="padding: 5px;">
            <span class="close">&times;</span>
            <form id="angkatanForm">
                @csrf
                <input type="hidden" id="angkatanId">
                <div class="form-group">
                    <label for="tahun_angkatan">Tahun Angkatan:</label>
                    <input type="text" class="form-control" id="tahun_angkatan" required>
                </div>
                <button type="submit" class="btn btn-success">Simpan</button>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#addAngkatan').click(function() {
            $('#angkatanId').val('');
            $('#tahun_angkatan').val('');
            $('.modal').css('display', 'block');
        });

        $('.close').click(function() {
            $('.modal').css('display', 'none');
        });

        $('.edit').click(function() {
            var id = $(this).data('id');
            $.ajax({
                url: '/angkatan/' + id + '/edit',
                method: 'GET',
                success: function(data) {
                    $('#angkatanId').val(data.id);
                    $('#tahun_angkatan').val(data.tahun_angkatan);
                    $('.modal').css('display', 'block');
                }
            });
        });

        $('#angkatanForm').submit(function(e) {
            e.preventDefault();
            var id = $('#angkatanId').val();
            var tahun_angkatan = $('#tahun_angkatan').val();
            var url = id ? '/angkatan/' + id : '/angkatan';

            $.ajax({
                url: url,
                method: id ? 'PUT' : 'POST',
                data: {
                    _token: $('input[name=_token]').val(),
                    tahun_angkatan: tahun_angkatan
                },
                success: function(data) {
                    if (data.success) {
                        Swal.fire({
                            title: 'Berhasil',
                            text: 'Data angkatan berhasil disimpan',
                            icon: 'success',
                            timer: 1500
                        }).then(function() {
                            location.reload();
                        });
                    }
                }
            });

            $('.modal').css('display', 'none');
        });

        $('.delete').click(function() {
            var id = $(this).data('id');
            Swal.fire({
                title: 'Konfirmasi',
                text: 'Apakah Anda yakin ingin menghapus data angkatan?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, Hapus',
                cancelButtonText: 'Batal'
            }).then(function(result) {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '/angkatan/' + id,
                        method: 'DELETE',
                        data: {
                            _token: $('input[name=_token]').val()
                        },
                        success: function(data) {
                            if (data.success) {
                                Swal.fire({
                                    title: 'Berhasil',
                                    text: 'Data angkatan berhasil dihapus',
                                    icon: 'success',
                                    timer: 1500
                                }).then(function() {
                                    location.reload();
                                });
                            }
                        }
                    });
                }
            });
        });

        $('#refreshAngkatan').click(function() {
            location.reload();
        });

        $('#searchInput').on('keyup', function() {
            var input = $(this).val().toLowerCase();
            $('#angkatanList li').filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(input) > -1);
            });
        });
    });
</script>
@endsection
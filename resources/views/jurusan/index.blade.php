@extends('templates.frontend')

@section('content')
<div class="card card-style">
    <div class="content">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2 class="mb-0">Data Jurusan</h2>
            <div class="d-flex align-items-center">
                <button id="addJurusan" class="btn btn-primary ml-2">
                    <i class="fa fa-plus"></i>
                </button>
                <a href="{{ route('jurusan.index') }}" class="btn btn-secondary ml-2">
                    <i class="fa fa-refresh"></i>
                </a>
            </div>
        </div>
        <input type="text" id="searchInput" class="form-control mb-3" placeholder="Cari Nama Jurusan">

        <ul class="list-unstyled" id="jurusanList">
            @foreach ($jurusans as $jurusan)
            <li class="mb-3">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <h6 class="font-12 font-600 mb-1">{{ $jurusan->nama_jurusan }}</h6>
                        <p class="opacity-60 font-10 mb-0">ID: {{ $jurusan->id }}</p>
                    </div>
                    <div>
                        <button class="btn btn-info edit" data-id="{{ $jurusan->id }}">
                            <i class="fa fa-edit"></i>
                        </button>
                        <button class="btn btn-danger delete" data-id="{{ $jurusan->id }}">
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
            <form id="jurusanForm">
                @csrf
                <input type="hidden" id="jurusanId">
                <div class="form-group">
                    <label for="nama_jurusan">Nama Jurusan:</label>
                    <input type="text" class="form-control" id="nama_jurusan" required>
                </div>
                <button type="submit" class="btn btn-success">Simpan</button>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#addJurusan').click(function() {
            $('#jurusanId').val('');
            $('#nama_jurusan').val('');
            $('.modal').css('display', 'block');
        });

        $('.close').click(function() {
            $('.modal').css('display', 'none');
        });

        $('.edit').click(function() {
            var id = $(this).data('id');
            $.ajax({
                url: '/jurusan/' + id + '/edit',
                method: 'GET',
                success: function(data) {
                    $('#jurusanId').val(data.id);
                    $('#nama_jurusan').val(data.nama_jurusan);
                    $('.modal').css('display', 'block');
                }
            });
        });

        $('#jurusanForm').submit(function(e) {
            e.preventDefault();
            var id = $('#jurusanId').val();
            var nama_jurusan = $('#nama_jurusan').val();
            var url = id ? '/jurusan/' + id : '/jurusan';

            $.ajax({
                url: url,
                method: id ? 'PUT' : 'POST',
                data: {
                    _token: $('input[name=_token]').val(),
                    nama_jurusan: nama_jurusan
                },
                success: function(data) {
                    if (data.success) {
                        Swal.fire({
                            title: 'Berhasil',
                            text: 'Data jurusan berhasil disimpan',
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
                text: 'Apakah Anda yakin ingin menghapus data jurusan?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, Hapus',
                cancelButtonText: 'Batal'
            }).then(function(result) {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '/jurusan/' + id,
                        method: 'DELETE',
                        data: {
                            _token: $('input[name=_token]').val()
                        },
                        success: function(data) {
                            if (data.success) {
                                Swal.fire({
                                    title: 'Berhasil',
                                    text: 'Data jurusan berhasil dihapus',
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

        $('#searchInput').on('keyup', function() {
            var input = $(this).val().toLowerCase();
            $('#jurusanList li').filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(input) > -1);
            });
        });
    });
</script>

@endsection
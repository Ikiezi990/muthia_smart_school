@extends('templates.frontend')

@section('content')
<div class="card card-style">
    <div class="content">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2 class="mb-0">Data Mata Pelajaran</h2>
            <div class="d-flex align-items-center">
                <button id="addMapel" class="btn btn-primary ml-2"><i class="fa fa-plus"></i></button>
            </div>
        </div>

        <input type="text" id="searchInput" class="form-control mb-3" placeholder="Cari Nama Mata Pelajaran">

        <ul class="list-unstyled" id="mapelList">
            @foreach ($mapels as $mapel)
            <li class="mb-3">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <h6 class="font-12 font-600 mb-1">{{ $mapel->nama_mapel }}</h6>
                        <p class="opacity-60 font-10 mb-0">ID: {{ $mapel->id }}</p>
                    </div>
                    <div>
                        <button class="btn btn-info edit" data-id="{{ $mapel->id }}">
                            <i class="fa fa-edit"></i>
                        </button>
                        <button class="btn btn-danger delete" data-id="{{ $mapel->id }}">
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
            <form id="mapelForm">
                @csrf
                <input type="hidden" id="mapelId">
                <div class="form-group">
                    <label for="nama_mapel">Nama Mata Pelajaran:</label>
                    <input type="text" class="form-control" id="nama_mapel" required>
                </div>
                <button type="submit" class="btn btn-success">Simpan</button>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#addMapel').click(function() {
            $('#mapelId').val('');
            $('#nama_mapel').val('');
            $('.modal').css('display', 'block');
        });

        $('.close').click(function() {
            $('.modal').css('display', 'none');
        });

        $('.edit').click(function() {
            var id = $(this).data('id');
            $.ajax({
                url: '/mapel/' + id + '/edit',
                method: 'GET',
                success: function(data) {
                    $('#mapelId').val(data.id);
                    $('#nama_mapel').val(data.nama_mapel);
                    $('.modal').css('display', 'block');
                }
            });
        });

        $('#mapelForm').submit(function(e) {
            e.preventDefault();
            var id = $('#mapelId').val();
            var nama_mapel = $('#nama_mapel').val();
            var url = id ? '/mapel/' + id : '/mapel';

            $.ajax({
                url: url,
                method: id ? 'PUT' : 'POST',
                data: {
                    _token: $('input[name=_token]').val(),
                    nama_mapel: nama_mapel
                },
                success: function(data) {
                    if (data.success) {
                        Swal.fire({
                            title: 'Berhasil',
                            text: 'Data mata pelajaran berhasil disimpan',
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
                text: 'Apakah Anda yakin ingin menghapus data mata pelajaran?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, Hapus',
                cancelButtonText: 'Batal'
            }).then(function(result) {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '/mapel/' + id,
                        method: 'DELETE',
                        data: {
                            _token: $('input[name=_token]').val()
                        },
                        success: function(data) {
                            if (data.success) {
                                Swal.fire({
                                    title: 'Berhasil',
                                    text: 'Data mata pelajaran berhasil dihapus',
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
            $('#mapelList li').filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(input) > -1);
            });
        });
    });
</script>

@endsection
@extends('templates.frontend')

@section('content')
<div class="card card-style">
    <div class="content">
        <div class="d-flex justify-content-between">
            <h2>Data Kelas</h2>
            <div class="d-flex justify-content-between">
                <button id="addKelas" class="btn btn-primary"><i class="fa fa-plus"></i></button>
                <button id="refreshPage" class="btn btn-secondary"><i class="fa fa-refresh"></i></button>
            </div>

        </div>
        <input type="text" id="searchInput" class="form-control mb-2 mt-2" placeholder="Cari Kelas">

        <div class="scrollable">
            <ul class="list-unstyled">
                @foreach ($kelases as $kelas)
                <li class="mb-3">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <h6 class="font-14 font-600 mb-1">Kelas: {{ $kelas->nama_kelas }}</h6>
                            <p class="opacity-60 font-10 mb-0">Angkatan: {{ $kelas->angkatan->tahun_angkatan }}</p>
                        </div>
                        <div>
                            <button class="btn btn-info edit" data-id="{{ $kelas->id }}">
                                <i class="fa fa-edit"></i>
                            </button>
                            <button class="btn btn-danger delete" data-id="{{ $kelas->id }}">
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
<div class="container">
    <div id="myModal" class="modal" style="padding: 5px;">
        <div class="modal-content" style="padding: 5px;">
            <span class="close">&times;</span>
            <form id="kelasForm">
                @csrf
                <input type="hidden" id="kelasId">
                <div class="form-group">
                    <label for="nama_kelas">Nama Kelas:</label>
                    <input type="text" class="form-control" id="nama_kelas" required>
                </div>
                <div class="form-group">
                    <label for="angkatan_id">Angkatan:</label>
                    <select class="form-control" id="angkatan_id" required>
                        @foreach ($angkatans as $angkatan)
                        <option value="{{ $angkatan->id }}">{{ $angkatan->tahun_angkatan }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-success">Simpan</button>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#refreshPage').click(function() {
            location.reload();
        });
        $('#addKelas').click(function() {
            $('#kelasId').val('');
            $('#nama_kelas').val('');
            $('#angkatan_id').val('');
            $('.modal').css('display', 'block');
        });

        $('.close').click(function() {
            $('.modal').css('display', 'none');
        });

        $('.edit').click(function() {
            var id = $(this).data('id');
            $.ajax({
                url: '/kelas/' + id + '/edit',
                method: 'GET',
                success: function(data) {
                    $('#kelasId').val(data.id);
                    $('#nama_kelas').val(data.nama_kelas);
                    $('#angkatan_id').val(data.angkatan_id);
                    $('.modal').css('display', 'block');
                }
            });
        });

        $('#kelasForm').submit(function(e) {
            e.preventDefault();
            var id = $('#kelasId').val();
            var nama_kelas = $('#nama_kelas').val();
            var angkatan_id = $('#angkatan_id').val();
            var url = id ? '/kelas/' + id : '/kelas';

            $.ajax({
                url: url,
                method: id ? 'PUT' : 'POST',
                data: {
                    _token: $('input[name=_token]').val(),
                    nama_kelas: nama_kelas,
                    angkatan_id: angkatan_id
                },
                success: function(data) {
                    if (data.success) {
                        Swal.fire({
                            title: 'Berhasil',
                            text: 'Data kelas berhasil disimpan',
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
                text: 'Apakah Anda yakin ingin menghapus data kelas?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, Hapus',
                cancelButtonText: 'Batal'
            }).then(function(result) {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '/kelas/' + id,
                        method: 'DELETE',
                        data: {
                            _token: $('input[name=_token]').val()
                        },
                        success: function(data) {
                            if (data.success) {
                                Swal.fire({
                                    title: 'Berhasil',
                                    text: 'Data kelas berhasil dihapus',
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

        function filterClasses(query) {
            $('.mb-3').each(function() {
                var className = $(this).find('.font-14.mb-1').text().toLowerCase();
                var angkatanYear = $(this).find('.opacity-60.font-10.mb-0').text().toLowerCase();
                if (className.includes(query) || angkatanYear.includes(query)) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
        }

        $('#searchInput').on('input', function() {
            var searchQuery = $(this).val().toLowerCase();
            filterClasses(searchQuery);
        });
    });
</script>

@endsection
@extends('templates.frontend')

@section('content')
<div class="card card-style">
    <div class="content">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2 class="mb-0">Data Guru</h2>
            <div class="d-flex align-items-center">
                <button id="addGuru" class="btn btn-primary ml-2"><i class="fa fa-plus"></i></button>
            </div>
        </div>

        <input type="text" id="searchInput" class="form-control mb-3" placeholder="Cari NIP atau Nama Guru">

        <ul class="list-unstyled" id="guruList">
            @foreach ($gurus as $guru)
            <li class="mb-3">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <h6 class="font-12 font-600 mb-1">{{ $guru->nama }}</h6>
                        <p class="opacity-60 font-10 mb-0">NIP: {{ $guru->nip }}</p>
                    </div>
                    <div>
                        <button class="btn btn-info edit" data-id="{{ $guru->id }}">
                            <i class="fa fa-edit"></i>
                        </button>
                        <button class="btn btn-danger delete" data-id="{{ $guru->id }}">
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
            <form id="guruForm">
                @csrf
                <input type="hidden" id="guruId">
                <div class="form-group">
                    <label for="nip">NIP:</label>
                    <input type="text" class="form-control" id="nip" required>
                </div>
                <div class="form-group">
                    <label for="nama">Nama Guru:</label>
                    <input type="text" class="form-control" id="nama" required>
                </div>
                <div class="form-group">
                    <label for="no_telpon">No. Telepon:</label>
                    <input type="text" class="form-control" id="no_telpon" required>
                </div>
                <button type="submit" class="btn btn-success">Simpan</button>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#addGuru').click(function() {
            $('#guruId').val('');
            $('#nip').val('');
            $('#nama').val('');
            $('#no_telpon').val('');
            $('.modal').css('display', 'block');
        });

        $('.close').click(function() {
            $('.modal').css('display', 'none');
        });

        $('.edit').click(function() {
            var id = $(this).data('id');
            $.ajax({
                url: '/guru/' + id + '/edit',
                method: 'GET',
                success: function(data) {
                    $('#guruId').val(data.id);
                    $('#nip').val(data.nip);
                    $('#nama').val(data.nama);
                    $('#no_telpon').val(data.no_telepon);
                    $('.modal').css('display', 'block');
                }
            });
        });

        $('#guruForm').submit(function(e) {
            e.preventDefault();
            var id = $('#guruId').val();
            var nip = $('#nip').val();
            var nama = $('#nama').val();
            var no_telpon = $('#no_telpon').val();
            var url = id ? '/guru/' + id : '/guru';

            $.ajax({
                url: url,
                method: id ? 'PUT' : 'POST',
                data: {
                    _token: $('input[name=_token]').val(),
                    nip: nip,
                    nama: nama,
                    no_telpon: no_telpon
                },
                success: function(data) {
                    if (data.success) {
                        Swal.fire({
                            title: 'Berhasil',
                            text: 'Data guru berhasil disimpan',
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
                text: 'Apakah Anda yakin ingin menghapus data guru?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, Hapus',
                cancelButtonText: 'Batal'
            }).then(function(result) {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '/guru/' + id,
                        method: 'DELETE',
                        data: {
                            _token: $('input[name=_token]').val()
                        },
                        success: function(data) {
                            if (data.success) {
                                Swal.fire({
                                    title: 'Berhasil',
                                    text: 'Data guru berhasil dihapus',
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
            $('#guruList li').filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(input) > -1);
            });
        });
    });
</script>

@endsection
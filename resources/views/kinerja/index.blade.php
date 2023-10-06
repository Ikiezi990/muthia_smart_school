@extends('templates.frontend')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.13.3/css/selectize.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.13.3/js/standalone/selectize.min.js"></script>
<div class="card card-style">
    <div class="content">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2 class="mb-0">Data Kinerja</h2>
            <div class="d-flex align-items-center">
                <button id="addKinerja" class="btn btn-primary ml-2"><i class="fa fa-plus"></i></button>
            </div>
        </div>
        <input type="text" id="searchInput" class="form-control" placeholder="Cari Nama Kinerja">

        <ul class="list-unstyled" id="kinerjaList">
            @foreach ($kinerjas as $kinerja)
            <li class="mb-3">
                <div class="d-flex align-items-center justify-content-between">
                    <div style="display: block;">
                        <h6 class="font-10 font-600 mb-1">{{ $kinerja->nama_kinerja }}</h6>
                        <p class="opacity-60 font-10 mb-0">Jenis: {{ $kinerja->jenis_kinerja }}, Poin: {{ $kinerja->poin_kinerja }}</p>
                    </div>
                    <div style="display: block;">
                        <button class="btn btn-info btn-small edit-kinerja" data-id="{{ $kinerja->id }}">
                            <i class="fa fa-edit"></i>
                        </button>
                        <button class="btn btn-danger delete-kinerja" data-id="{{ $kinerja->id }}">
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
            <div style="overflow: scroll;max-height: 600px;">
                <form id="kinerjaForm">
                    @csrf
                    <input type="hidden" id="kinerjaId">
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label for="nama_kinerja">Nama Kinerja:</label>
                            <input type="text" class="form-control" id="nama_kinerja" required>
                        </div>
                        <div class="col-md-6">
                            <label for="jenis_kinerja">Jenis Kinerja:</label>
                            <select class="form-control" id="jenis_kinerja" required>
                                <option value="punishment">Punishment</option>
                                <option value="reward">Reward</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label for="poin_kinerja">Poin Kinerja:</label>
                            <input type="number" class="form-control" id="poin_kinerja" required>
                        </div>
                    </div>
                    <!-- Tambahkan input untuk kolom lainnya sesuai dengan kebutuhan -->
                    <button type="submit" class="btn btn-success">Simpan</button>
                </form>
            </div>

        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#addKinerja').click(function() {
            $('#kinerjaId').val('');
            $('#nama_kinerja').val('');
            $('#jenis_kinerja').val('');
            $('#poin_kinerja').val('');
            $('#myModal').css('display', 'block');
        });

        $('.close').click(function() {
            $('.modal').css('display', 'none');
        });

        $('.edit-kinerja').click(function() {
            var id = $(this).data('id');
            $.ajax({
                url: '/kinerja/' + id + '/edit',
                method: 'GET',
                success: function(data) {
                    $('#kinerjaId').val(data.id);
                    $('#nama_kinerja').val(data.nama_kinerja);
                    $('#jenis_kinerja').val(data.jenis_kinerja);
                    $('#poin_kinerja').val(data.poin_kinerja);
                    $('#myModal').css('display', 'block');
                }
            });
        });

        $('#kinerjaForm').submit(function(e) {
            e.preventDefault();
            var id = $('#kinerjaId').val();
            var nama_kinerja = $('#nama_kinerja').val();
            var jenis_kinerja = $('#jenis_kinerja').val();
            var poin_kinerja = $('#poin_kinerja').val();

            var url = id ? '/kinerja/' + id : '/kinerja';

            $.ajax({
                url: url,
                method: id ? 'PUT' : 'POST',
                data: {
                    _token: $('input[name=_token]').val(),
                    nama_kinerja: nama_kinerja,
                    jenis_kinerja: jenis_kinerja,
                    poin_kinerja: poin_kinerja,
                },
                success: function(data) {
                    if (data.success) {
                        Swal.fire({
                            title: 'Berhasil',
                            text: 'Data kinerja berhasil disimpan',
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

        $('#searchInput').on('input', function() {
            var searchQuery = $(this).val().toLowerCase();
            filterKinerjas(searchQuery);
        });

        function filterKinerjas(query) {
            $('.mb-3').each(function() {
                var kinerjaName = $(this).find('.font-10.mb-1').text().toLowerCase();
                var kinerjaDetails = $(this).find('.opacity-60.font-10.mb-0').text().toLowerCase();

                if (kinerjaName.includes(query) || kinerjaDetails.includes(query)) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
        }
    });
</script>

@endsection
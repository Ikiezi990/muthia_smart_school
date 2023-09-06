@extends('templates.frontend')

@section('content')
<div class="card card-style">
    <div class="content">
        <div class="d-flex justify-content-between">
            <h2>Data Kelas</h2>
            <div class="d-flex justify-content-between">
                <button id="addTagihan" class="btn btn-primary"><i class="fa fa-plus"></i></button>
                <button id="refreshPage" class="btn btn-secondary"><i class="fa fa-refresh"></i></button>
            </div>

        </div>
        <input type="text" id="searchInput" class="form-control mb-2 mt-2" placeholder="Cari Kelas">

        <div class="scrollable">
            <ul class="list-unstyled">
                @foreach ($tagihans as $tagihan)
                <li class="mb-3">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <h6 class="font-14 font-600 mb-1">{{ $tagihan->nama_tagihan }}</h6>
                            <h6 class="font-14 font-600 mb-1">{{ $tagihan->nominal_tagihan }}</h6>
                            <p class="opacity-60 font-10 mb-0">Kelas: {{ $tagihan->kelas->nama_kelas }}</p>
                        </div>
                        <div>
                            <button class="btn btn-info edit" data-id="{{ $tagihan->id }}">
                                <i class="fa fa-edit"></i>
                            </button>
                            <button class="btn btn-danger delete" data-id="{{ $tagihan->id }}">
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
            <form id="tagihanForm">
                @csrf
                <input type="hidden" id="tagihanId">
                <div class="form-group">
                    <label for="nama_tagihan">Nama Tagihan:</label>
                    <input type="text" class="form-control" id="nama_tagihan" required>
                </div>
                <div class="form-group">
                    <label for="nominal">Nominal:</label>
                    <input type="text" class="form-control" id="nominal" required>
                </div>
                <div class="form-group">
                    <label for="kelas">Kelas:</label>
                    <select class="form-control" id="kelas_id" required>
                        @foreach ($kelases as $kelas)
                        <option value="{{ $kelas->id }}">{{ $kelas->nama_kelas }}</option>
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
        $('#addTagihan').click(function() {
            $('#tagihanId').val('');
            $('#nama_tagihan').val('');
            $('#nominal').val('');
            $('#kelas_id').val('');
            $('.modal').css('display', 'block');
        });

        $('.close').click(function() {
            $('.modal').css('display', 'none');
        });

        $('.edit').click(function() {
            var id = $(this).data('id');
            $.ajax({
                url: '/tagihan/' + id + '/edit',
                method: 'GET',
                success: function(data) {
                    $('#tagihanId').val(data.id);
                    $('#nama_tagihan').val(data.nama_tagihan);
                    $('#nominal').val(data.nominal);
                    $('#kelas_id').val(data.kelas_id);
                    $('.modal').css('display', 'block');
                }
            });
        });

        $('#tagihanForm').submit(function(e) {
            e.preventDefault();
            var id = $('#tagihanId').val();
            var nama_tagihan = $('#nama_tagihan').val();
            var nominal = $('#nominal').val();
            var kelas_id = $('#kelas_id').val();
            var url = id ? '/tagihan/' + id : '/tagihan';

            $.ajax({
                url: url,
                method: id ? 'PUT' : 'POST',
                data: {
                    _token: $('input[name=_token]').val(),
                    nama_tagihan: nama_tagihan,
                    kelas_id: kelas_id,
                    nominal: nominal
                },
                success: function(data) {
                    if (data.success) {
                        Swal.fire({
                            title: 'Berhasil',
                            text: 'Data Tagihan berhasil disimpan',
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
                text: 'Apakah Anda yakin ingin menghapus data tagihan?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, Hapus',
                cancelButtonText: 'Batal'
            }).then(function(result) {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '/tagihan/' + id,
                        method: 'DELETE',
                        data: {
                            _token: $('input[name=_token]').val()
                        },
                        success: function(data) {
                            if (data.success) {
                                Swal.fire({
                                    title: 'Berhasil',
                                    text: 'Data Tagihan berhasil dihapus',
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
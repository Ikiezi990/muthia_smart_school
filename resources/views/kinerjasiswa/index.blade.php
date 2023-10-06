@extends('templates.frontend')

@section('content')
<style>
    #siswa_id {

        width: 300px;

    }
</style>

<div class="card card-style">
    <div class="content">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2 class="mb-0">Data Kinerja Siswa</h2>
            <div class="d-flex align-items-center">
                <button id="addKinerjaSiswa" class="btn btn-primary ml-2"><i class="fa fa-plus"></i></button>
            </div>
        </div>
        <input type="text" id="searchInput" class="form-control" placeholder="Cari NISN Siswa atau Nama Kinerja">

        <ul class="list-unstyled" id="kinerjaSiswaList">
            @foreach ($kinerjaSiswa as $item)
            <li class="mb-3">
                <div class="d-flex align-items-center justify-content-between">
                    <div style="display: block;">
                        <h6 class="font-10 font-600 mb-1">{{ $item->siswa->nama_lengkap }}</h6>
                        <p class="opacity-60 font-10 mb-0">NISN: {{ $item->siswa->nisn }}</p>
                        <p class="opacity-60 font-10 mb-0">Kinerja: {{ $item->kinerja->nama_kinerja }}</p>
                        <p class="opacity-60 font-10 mb-0">Poin: {{ $item->kinerja->poin_kinerja }}</p>
                    </div>
                    <div style="display: block;">
                        <button class="btn btn-info btn-small edit-kinerja-siswa" data-id="{{ $item->id }}">
                            <i class="fa fa-edit"></i>
                        </button>
                        <button class="btn btn-danger btn-small delete-kinerja-siswa" data-id="{{ $item->id }}">
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
    <div id="kinerjaSiswaModal" class="modal" style="padding: 5px;">
        <div class="modal-content" style="padding: 5px;">
            <span class="close">&times;</span>
            <div style="overflow: scroll;max-height: 600px;">
                <form id="kinerjaSiswaForm">
                    @csrf
                    <input type="hidden" id="kinerjaSiswaId">
                    <div class="form-group">
                        <label for="siswa_id">Siswa</label>
                        <select id="siswa_id">
                            @foreach ($siswa as $s)
                            <option value="{{ $s->id }}">{{ $s->nama_lengkap }} (NISN: {{ $s->nisn }})</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="kinerja_id">Kinerja</label>
                        <select class="form-control" id="kinerja_id" required>
                            @foreach ($kinerja as $k)
                            <option value="{{ $k->id }}">{{ $k->nama_kinerja }} (Poin: {{ $k->poin_kinerja }})</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-success">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div id="detailKinerjaSiswaModal" class="modal">
        <div class="modal-content">
            <span class="close-detail">&times;</span>
            <div id="detailKinerjaSiswaContent"></div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {

        $('#addKinerjaSiswa').click(function() {
            $('#kinerjaSiswaId').val('');
            $('#siswa_id').val('');
            $('#kinerja_id').val('');
            $('#kinerjaSiswaModal').css('display', 'block');
        });

        $('.close').click(function() {
            $('#kinerjaSiswaModal').css('display', 'none');
        });

        $('.edit-kinerja-siswa').click(function() {
            var id = $(this).data('id');
            $.ajax({
                url: '/kinerja-siswa/' + id + '/edit',
                method: 'GET',
                success: function(data) {
                    $('#kinerjaSiswaId').val(data.id);
                    $('#siswa_id').val(data.siswa_id);
                    $('#kinerja_id').val(data.kinerja_id);
                    $('#kinerjaSiswaModal').css('display', 'block');
                }
            });
        });

        $('.detail-kinerja-siswa').click(function() {
            var id = $(this).data('id');
            $.ajax({
                url: '/kinerja-siswa/' + id,
                method: 'GET',
                success: function(data) {
                    console.log(data);
                    var detailKinerjaSiswaHtml = '<div class="d-flex align-items-center justify-content-between">';
                    detailKinerjaSiswaHtml += '<div class="container">';
                    detailKinerjaSiswaHtml += '<h6 class="font-14 font-600 mb-3">Detail Kinerja Siswa</h6>';
                    detailKinerjaSiswaHtml += '<ul class="list-unstyled">';
                    detailKinerjaSiswaHtml += '<li>Nama Siswa: ' + data.siswa.nama_lengkap + '</li>';
                    detailKinerjaSiswaHtml += '<li>NISN: ' + data.siswa.nisn + '</li>';
                    detailKinerjaSiswaHtml += '<li>Nama Kinerja: ' + data.kinerja.nama_kinerja + '</li>';
                    detailKinerjaSiswaHtml += '<li>Poin Kinerja: ' + data.kinerja.poin_kinerja + '</li>';
                    detailKinerjaSiswaHtml += '<li>Tanggal Pencatatan: ' + data.created_at + '</li>';
                    detailKinerjaSiswaHtml += '</ul>';
                    detailKinerjaSiswaHtml += '</div>';
                    detailKinerjaSiswaHtml += '<div>';
                    detailKinerjaSiswaHtml += '</div>';
                    detailKinerjaSiswaHtml += '</div>';

                    $('#detailKinerjaSiswaContent').html(detailKinerjaSiswaHtml);
                    $('#detailKinerjaSiswaModal').css('display', 'block');
                }
            });
        });

        $('#kinerjaSiswaForm').submit(function(e) {
            e.preventDefault();
            var id = $('#kinerjaSiswaId').val();
            var siswa_id = $('#siswa_id').val();
            var kinerja_id = $('#kinerja_id').val();

            var url = id ? '/kinerja-siswa/' + id : '/kinerja-siswa';

            $.ajax({
                url: url,
                method: id ? 'PUT' : 'POST',
                data: {
                    _token: $('input[name=_token]').val(),
                    siswa_id: siswa_id,
                    kinerja_id: kinerja_id
                },
                success: function(data) {
                    if (data.success) {
                        Swal.fire({
                            title: 'Berhasil',
                            text: 'Data kinerja siswa berhasil disimpan',
                            icon: 'success',
                            timer: 1500
                        }).then(function() {
                            location.reload();
                        });
                    }
                }
            });

            $('#kinerjaSiswaModal').css('display', 'none');
        });

        $('.close-detail').click(function() {
            $('#detailKinerjaSiswaModal').css('display', 'none');
        });

        function filterKinerjaSiswa(query) {
            $('.mb-3').each(function() {
                var studentName = $(this).find('.font-10.mb-1').text().toLowerCase();
                var studentNISN = $(this).find('.opacity-60.font-10.mb-0').text().toLowerCase();
                var kinerjaName = $(this).find('.opacity-60.font-10.mb-0').text().toLowerCase();

                if (studentName.includes(query) || studentNISN.includes(query) || kinerjaName.includes(query)) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
        }

        $('#searchInput').on('input', function() {
            var searchQuery = $(this).val().toLowerCase();
            filterKinerjaSiswa(searchQuery);
        });
        $('.delete-kinerja-siswa').click(function() {
            var id = $(this).data('id');
            Swal.fire({
                title: 'Konfirmasi',
                text: 'Anda yakin ingin menghapus data ini?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Hapus!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '/kinerja-siswa/' + id,
                        method: 'DELETE',
                        data: {
                            _token: $('input[name=_token]').val()
                        },
                        success: function(data) {
                            if (data.message) {
                                Swal.fire({
                                    title: 'Berhasil',
                                    text: data.message,
                                    icon: 'success',
                                    timer: 1500
                                }).then(function() {
                                    // Hapus item dari daftar setelah penghapusan
                                    $('.delete-kinerja-siswa[data-id="' + id + '"]').closest('li').remove();
                                });
                            }
                        }
                    });
                }
            });
        });

    });
</script>
<script>
    $('#siswa_id').selectize({
        create: false, // Set to true if you want to allow creating new items
        sortField: 'text',
    });
</script>
@endsection
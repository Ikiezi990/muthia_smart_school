@extends('templates.frontend')

@section('content')
<div class="card card-style">
    <div class="content">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2 class="mb-0">Data Siswa</h2>
            <div class="d-flex align-items-center">
                <button id="addSiswa" class="btn btn-primary ml-2"><i class="fa fa-plus"></i></button>
            </div>
        </div>
        <input type="text" id="searchInput" class="form-control" placeholder="Cari NISN atau Nama Siswa">

        <ul class="list-unstyled" id="siswaList">
            @foreach ($siswas as $siswa)
            <li class="mb-3">
                <div class="d-flex align-items-center justify-content-between">
                    <div style="display: block;">
                        <h6 class="font-10 font-600 mb-1">{{ $siswa->nama_lengkap }}</h6>
                        <p class="opacity-60 font-10 mb-0">NISN: {{ $siswa->nisn }}</p>
                    </div>
                    <div style="display: block;">
                        <button class="btn btn-info btn-small edit-siswa" data-id="{{ $siswa->id }}">
                            <i class="fa fa-edit"></i>
                        </button>
                        <button class="btn btn-danger delete-siswa" data-id="{{ $siswa->id }}">
                            <i class="fa fa-trash"></i>
                        </button>
                        <button class="btn btn-primary detail-siswa" data-id="{{ $siswa->id }}">
                            <i class="fa fa-eye"></i>
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
                <form id="siswaForm">
                    @csrf
                    <input type="hidden" id="siswaId">
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label for="nama_lengkap">Nama Lengkap:</label>
                            <input type="text" class="form-control" id="nama_lengkap" required>
                        </div>
                        <div class="col-md-6">
                            <label for="nisn">NISN:</label>
                            <input type="text" class="form-control" id="nisn" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label for="tempat_lahir">Tempat Lahir:</label>
                            <input type="text" class="form-control" id="tempat_lahir" required>
                        </div>
                        <div class="col-md-6">
                            <label for="tanggal_lahir">Tanggal Lahir:</label>
                            <input type="date" class="form-control" id="tanggal_lahir" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label for="jenis_kelamin">Jenis Kelamin:</label>
                            <select class="form-control" id="jenis_kelamin" required>
                                <option value="laki-laki">Laki-laki</option>
                                <option value="perempuan">Perempuan</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="agama">Agama:</label>
                            <input type="text" class="form-control" id="agama" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label for="kewarganegaraan">Kewarganegaraan:</label>
                            <input type="text" class="form-control" id="kewarganegaraan" required>
                        </div>
                        <div class="col-md-6">
                            <label for="alamat">Alamat:</label>
                            <textarea class="form-control" id="alamat" rows="3" required></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label for="kelas_id">Kelas:</label>
                            <select class="form-control" id="kelas_id" required>
                                @foreach ($kelas as $kelas)
                                <option value="{{ $kelas->id }}">{{ $kelas->nama_kelas }} - {{ $kelas->angkatan->tahun_angkatan }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <!-- Tambahkan input untuk kolom lainnya sesuai dengan kebutuhan -->
                    <button type="submit" class="btn btn-success">Simpan</button>
                </form>
            </div>

        </div>
    </div>
</div>

<div class="container">
    <div id="detailModal" class="modal">
        <div class="modal-content">
            <span class="close-detail">&times;</span>
            <div id="detailContent"></div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#addSiswa').click(function() {
            $('#siswaId').val('');
            $('#nama_lengkap').val('');
            $('#nisn').val('');
            $('#tempat_lahir').val('');
            $('#tanggal_lahir').val('');
            $('#jenis_kelamin').val('');
            $('#agama').val('');
            $('#kewarganegaraan').val('');
            $('#alamat').val('');
            $('#kelas_id').val('');
            $('#myModal').css('display', 'block');
        });

        $('.close').click(function() {
            $('.modal').css('display', 'none');
        });

        $('.edit-siswa').click(function() {
            var id = $(this).data('id');
            $.ajax({
                url: '/siswa/' + id + '/edit',
                method: 'GET',
                success: function(data) {
                    $('#siswaId').val(data.id);
                    $('#nama_lengkap').val(data.nama_lengkap);
                    $('#nisn').val(data.nisn);
                    $('#tempat_lahir').val(data.tempat_lahir);
                    $('#tanggal_lahir').val(data.tanggal_lahir);
                    $('#jenis_kelamin').val(data.jenis_kelamin);
                    $('#agama').val(data.agama);
                    $('#kewarganegaraan').val(data.kewarganegaraan);
                    $('#alamat').val(data.alamat);
                    $('#kelas_id').val(data.kelas_id);
                    $('#myModal').css('display', 'block');
                }
            });
        });

        $('.detail-siswa').click(function() {
            var id = $(this).data('id');
            $.ajax({
                url: '/siswa/' + id,
                method: 'GET',
                success: function(data) {
                    console.log(data);
                    var detailHtml = '<div class="d-flex align-items-center justify-content-between">';
                    detailHtml += '<div class="container">';
                    detailHtml += '<h6 class="font-14 font-600 mb-3">Detail Siswa</h6>';
                    detailHtml += '<ul class="list-unstyled">';
                    detailHtml += '<li>Nama Lengkap: ' + data.nama_lengkap + '</li>';
                    detailHtml += '<li>NISN: ' + data.nisn + '</li>';
                    detailHtml += '<li>Tempat Lahir: ' + data.tempat_lahir + '</li>';
                    detailHtml += '<li>Tanggal Lahir: ' + data.tanggal_lahir + '</li>';
                    detailHtml += '<li>Jenis Kelamin: ' + data.jenis_kelamin + '</li>';
                    detailHtml += '<li>Agama: ' + data.agama + '</li>';
                    detailHtml += '<li>Kewarganegaraan: ' + data.kewarganegaraan + '</li>';
                    detailHtml += '<li>Alamat: ' + data.alamat + '</li>';
                    detailHtml += '<li>Kelas: ' + data.kelas + '</li>';
                    detailHtml += '</ul>';
                    detailHtml += '</div>';
                    detailHtml += '<div>';
                    detailHtml += '</div>';
                    detailHtml += '</div>';

                    $('#detailContent').html(detailHtml);
                    $('#detailModal').css('display', 'block');
                }
            });
        });
        $('#siswaForm').submit(function(e) {
            e.preventDefault();
            var id = $('#siswaId').val();
            var nama_lengkap = $('#nama_lengkap').val();
            var nisn = $('#nisn').val();
            var tempat_lahir = $('#tempat_lahir').val();
            var tanggal_lahir = $('#tanggal_lahir').val();
            var jenis_kelamin = $('#jenis_kelamin').val();
            var agama = $('#agama').val();
            var kewarganegaraan = $('#kewarganegaraan').val();
            var alamat = $('#alamat').val();
            var kelas_id = $('#kelas_id').val();

            var url = id ? '/siswa/' + id : '/siswa';

            $.ajax({
                url: url,
                method: id ? 'PUT' : 'POST',
                data: {
                    _token: $('input[name=_token]').val(),
                    nama_lengkap: nama_lengkap,
                    nisn: nisn,
                    tempat_lahir: tempat_lahir,
                    tanggal_lahir: tanggal_lahir,
                    jenis_kelamin: jenis_kelamin,
                    agama: agama,
                    kewarganegaraan: kewarganegaraan,
                    alamat: alamat,
                    kelas_id: kelas_id,
                },
                success: function(data) {
                    if (data.success) {
                        Swal.fire({
                            title: 'Berhasil',
                            text: 'Data siswa berhasil disimpan',
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
        $('.close-detail').click(function() {
            $('#detailModal').css('display', 'none');
        });

        function filterStudents(query) {

            $('.mb-3').each(function() {
                var studentName = $(this).find('.font-10.mb-1').text().toLowerCase();
                var studentNISN = $(this).find('.opacity-60.font-10.mb-0').text().toLowerCase();

                if (studentName.includes(query) || studentNISN.includes(query)) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
        }

        $('#searchInput').on('input', function() {
            var searchQuery = $(this).val().toLowerCase();
            filterStudents(searchQuery);
        });
    });
</script>

@endsection
@extends('templates.frontend')

@section('content')

<div class="card card-style">
    <div class="content">
        <div class="d-flex justify-content-between">
            <h2>Data Surat</h2>
            <div class="d-flex justify-content-between">
                <button id="addSurat" class="btn btn-primary"><i class="fa fa-plus"></i></button>
                <button id="refreshPage" class="btn btn-secondary"><i class="fa fa-refresh"></i></button>
            </div>
        </div>
        <input type="text" id="searchInput" class="form-control mb-2 mt-2" placeholder="Cari Surat">

        <div class="scrollable">
            <ul class="list-unstyled">
                @if(auth()->user()->is_admin=="guru")
                @foreach ($surats as $surat)
                <li class="mb-3">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <h6>{{ $surat->siswa->nama_lengkap }}</h6>
                            <p class="opacity-60 font-10 mb-0" style="text-transform: capitalize;">Jenis Surat : {{ $surat->jenis_surat }}</p>
                            <p class="opacity-60 font-10 mb-0">Tanggal Surat: {{ $surat->tanggal_surat }}</p>
                            <p class="opacity-60 font-10 mb-0">Lampiran: {{ $surat->lampiran }}</p>
                        </div>
                        <div>
                            <a href="#" id="downloadSurat" data-surat-id="{{ $surat->id }}" class="btn btn-primary">
                                <i class="fa fa-info"></i> Download
                            </a>
                        </div>
                    </div>
                </li>
                @endforeach
                @else
                @foreach ($surats as $surat)
                <li class="mb-3">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <h6 class="font-12 font-600 mb-1" style="text-transform: capitalize;">Jenis Surat : {{ $surat->jenis_surat }}</h6>
                            <p class="opacity-60 font-10 mb-0">Tanggal Surat: {{ $surat->tanggal_surat }}</p>
                            <p class="opacity-60 font-10 mb-0">Lampiran: {{ $surat->lampiran }}</p>
                        </div>
                        <div>
                            <button class="btn btn-danger delete" data-id="{{ $surat->id }}">
                                <i class="fa fa-trash"></i>
                            </button>
                        </div>
                    </div>
                </li>

                @endforeach
                @endif
            </ul>
        </div>
    </div>
</div>

<div class="container">
    <div id="myModal" class="modal" style="padding: 5px;">
        <div class="modal-content" style="padding: 5px;">
            <span class="close">&times;</span>
            <form id="suratForm" enctype="multipart/form-data">
                @csrf
                <input type="hidden" id="suratId">
                <div class="form-group">
                    <label for="jenis_surat">Jenis Surat:</label>
                    <select class="form-control" id="jenis_surat" required>
                        <option value="sakit">Sakit</option>
                        <option value="izin">Izin</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="tanggal_surat">Tanggal Surat:</label>
                    <input type="date" class="form-control" id="tanggal_surat" required>
                </div>
                <div class="form-group">
                    <label for="lampiran">Lampiran:</label>
                    <input type="file" class="form-control" id="lampiran" name="lampiran">
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

        $('#addSurat').click(function() {
            $('#suratId').val('');
            $('#jenis_surat').val('');
            $('#tanggal_surat').val('');
            $('#lampiran').val('');
            $('.modal').css('display', 'block');
        });

        $('.close').click(function() {
            $('.modal').css('display', 'none');
        });

        $('.edit').click(function() {
            var id = $(this).data('id');
            $.ajax({
                url: '/surat/' + id + '/edit',
                method: 'GET',
                success: function(data) {
                    $('#suratId').val(data.id);
                    $('#jenis_surat').val(data.jenis_surat);
                    $('#tanggal_surat').val(data.tanggal_surat);
                    // Anda bisa menampilkan nama file lampiran jika dibutuhkan
                    // $('#lampiran').val(data.lampiran);
                    $('.modal').css('display', 'block');
                }
            });
        });

        $('#suratForm').submit(function(e) {
            e.preventDefault();
            var id = $('#suratId').val();
            var jenis_surat = $('#jenis_surat').val();
            var tanggal_surat = $('#tanggal_surat').val();

            // Menggunakan FormData untuk mengirim file
            var formData = new FormData();
            formData.append('_token', $('input[name=_token]').val());
            formData.append('jenis_surat', jenis_surat);
            formData.append('tanggal_surat', tanggal_surat);

            // Mengambil file yang dipilih oleh pengguna
            var lampiran = $('#lampiran')[0].files[0];
            if (lampiran) {
                formData.append('lampiran', lampiran);
            }

            var url = id ? '/surat/' + id : '/surat';

            $.ajax({
                url: url,
                method: id ? 'PUT' : 'POST',
                data: formData,
                contentType: false, // Penting untuk menghindari kesalahan dalam pengiriman file
                processData: false, // Penting agar FormData tidak diproses secara otomatis
                success: function(data) {
                    if (data.success) {
                        Swal.fire({
                            title: 'Berhasil',
                            text: 'Data surat berhasil disimpan',
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
                text: 'Apakah Anda yakin ingin menghapus data surat?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, Hapus',
                cancelButtonText: 'Batal'
            }).then(function(result) {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '/surat/' + id,
                        method: 'DELETE',
                        data: {
                            _token: $('input[name=_token]').val()
                        },
                        success: function(data) {
                            if (data.success) {
                                Swal.fire({
                                    title: 'Berhasil',
                                    text: 'Data surat berhasil dihapus',
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

        function filterSurat(query) {
            $('.mb-3').each(function() {
                var jenisSurat = $(this).find('.font-12.mb-1').text().toLowerCase();
                var tanggalSurat = $(this).find('.opacity-60.font-10.mb-0').text().toLowerCase();

                if (jenisSurat.includes(query) || tanggalSurat.includes(query)) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
        }

        $('#searchInput').on('input', function() {
            var searchQuery = $(this).val().toLowerCase();
            filterSurat(searchQuery);
        });

    });
</script>
<script>
    $(document).ready(function() {
        $('#downloadSurat').click(function(e) {
            e.preventDefault(); // Menghentikan tindakan default dari link

            var suratId = $(this).data('surat-id'); // Mendapatkan ID surat dari atribut data

            // Membuat URL untuk mengarahkan ke rute 'surat.download' dengan ID surat
            var downloadUrl = "{{ url('surat/') }}/" + suratId + "/download";

            // Menampilkan SweetAlert dengan indikator loading
            Swal.fire({
                title: 'Sedang mengunduh...',
                onBeforeOpen: () => {
                    Swal.showLoading();
                }
            });

            // Melakukan permintaan AJAX
            $.ajax({
                url: downloadUrl,
                method: 'GET',
                success: function(data) {
                    // Menyembunyikan SweetAlert ketika unduhan berhasil
                    Swal.close();

                    // Handle hasil unduhan di sini jika diperlukan
                },
                error: function(error) {
                    // Menyembunyikan SweetAlert ketika ada kesalahan
                    Swal.close();

                    // Menampilkan SweetAlert kesalahan
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text: 'Dokumen berhasil di unduh!'
                    });
                }
            });
        });
    });
</script>


@endsection
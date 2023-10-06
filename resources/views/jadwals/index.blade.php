@extends('templates.frontend')

@section('content')
<div class="card card-style">
    <div class="content">
        <div class="d-flex justify-content-between">
            <h2>Data Jadwal</h2>
            <div class="d-flex justify-content-between">
                <button id="addJadwal" class="btn btn-primary"><i class="fa fa-plus"></i></button>
                <button id="refreshPage" class="btn btn-secondary"><i class="fa fa-refresh"></i></button>
            </div>
        </div>
        <input type="text" id="searchInput" class="form-control mb-2 mt-2" placeholder="Cari Jadwal">

        <div class="scrollable">
            <ul class="list-unstyled" id="jadwalList">
                @foreach ($jadwal as $jadwal)
                <li class="mb-3">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <h6 class="font-14 font-600 mb-1">Jam: {{ $jadwal->jam }}</h6>
                            <p class="opacity-60 font-10 mb-0">Hari: {{ $jadwal->hari }}</p>
                            <p class="opacity-60 font-10 mb-0">Hari: {{ $jadwal->mapel->nama_mapel }}</p>
                            <p class="opacity-60 font-10 mb-0">Kelas: {{ $jadwal->kelas->nama_kelas }}</p>
                            <p class="opacity-60 font-10 mb-0">Guru: {{ $jadwal->guru->nama }}</p>
                            <p class="opacity-60 font-10 mb-0">Tahun Ajaran: {{ $jadwal->tahun_ajaran }}</p>
                            <p class="opacity-60 font-10 mb-0">Semester: {{ $jadwal->semester }}</p>
                        </div>
                        <div>
                            <button class="btn btn-info edit" data-id="{{ $jadwal->id }}">
                                <i class="fa fa-edit"></i>
                            </button>
                            <button class="btn btn-danger delete" data-id="{{ $jadwal->id }}">
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
            <form id="jadwalForm">
                @csrf
                <input type="hidden" id="jadwalId">
                <div class="form-group">
                    <label for="jam">Jam:</label>
                    <input type="text" class="form-control" id="jam" required>
                </div>
                <div class="form-group">
                    <label for="hari">Hari:</label>
                    <select class="form-control" id="hari" required>
                        <option value="">Pilih Hari</option>
                        <option value="Senin">Senin</option>
                        <option value="Selasa">Selasa</option>
                        <option value="Rabu">Rabu</option>
                        <option value="Kamis">Kamis</option>
                        <option value="Jumat">Jumat</option>
                        <option value="Sabtu">Sabtu</option>
                        <option value="Minggu">Minggu</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="guru_id">Guru:</label>
                    <select class="form-control" id="guru_id" name="guru_id" required>
                        <option value="">Pilih Guru</option>
                        @foreach ($guru as $guruItem)
                        <option value="{{ $guruItem->id }}">{{ $guruItem->nama }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="kelas_id">Kelas:</label>
                    <select class="form-control" id="kelas_id" name="kelas_id" required>
                        <option value="">Pilih Kelas</option>
                        @foreach ($kelas as $kelasItem)
                        <option value="{{ $kelasItem->id }}">{{ $kelasItem->nama_kelas }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="kelas_id">Mapel:</label>
                    <select class="form-control" id="mapel_id" name="mapel_id" required>
                        <option value="">Pilih Mapel</option>
                        @foreach ($mapel as $mapelItem)
                        <option value="{{ $mapelItem->id }}">{{ $mapelItem->nama_mapel }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="semester">Semester:</label>
                    <select class="form-control" id="semester" name="semester" required>
                        <option value="">Pilih Semester</option>
                        <option value="1">Semester 1</option>
                        <option value="2">Semester 2</option>
                        <option value="3">Semester 3</option>
                        <option value="4">Semester 4</option>
                        <option value="5">Semester 5</option>
                        <option value="6">Semester 6</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="tahun_ajaran">Tahun Ajaran:</label>
                    <input type="text" class="form-control" id="tahun_ajaran" required>
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
        $('#addJadwal').click(function() {
            $('#jadwalId').val('');
            $('#jam').val('');
            $('#hari').val('');
            $('#kelas_id').val('');
            $('#guru_id').val('');
            $('#tahun_ajaran').val('');
            $('#semester').val('');
            $('#mapel_id').val('');
            $('.modal').css('display', 'block');
        });

        $('.close').click(function() {
            $('.modal').css('display', 'none');
        });

        $(document).on('click', '.edit', function() {
            var id = $(this).data('id');
            $.ajax({
                url: '/jadwal/' + id + '/edit',
                method: 'GET',
                success: function(data) {
                    $('#jadwalId').val(data.id);
                    $('#jam').val(data.jam);
                    $('#hari').val(data.hari);
                    $('#kelas_id').val(data.kelas_id);
                    $('#guru_id').val(data.guru_id);
                    $('#tahun_ajaran').val(data.tahun_ajaran);
                    $('#semester').val(data.semester);
                    $('.modal').css('display', 'block');
                }
            });
        });


        $('#jadwalForm').submit(function(e) {
            e.preventDefault();
            var id = $('#jadwalId').val();
            var jam = $('#jam').val();
            var hari = $('#hari').val();
            var kelas_id = $('#kelas_id').val();
            var guru_id = $('#guru_id').val();
            var tahun_ajaran = $('#tahun_ajaran').val();
            var semester = $('#semester').val();
            var mapel_id = $('#mapel_id').val();
            var url = id ? '/jadwal/' + id : '/jadwal';
            console.log(mapel_id);

            $.ajax({
                url: url,
                method: id ? 'PUT' : 'POST',
                data: {
                    _token: $('input[name=_token]').val(),
                    jam: jam,
                    hari: hari,
                    kelas_id: kelas_id,
                    guru_id: guru_id,
                    tahun_ajaran: tahun_ajaran,
                    semester: semester,
                    mapel_id: mapel_id
                },
                success: function(data) {
                    if (data.success) {
                        Swal.fire({
                            title: 'Berhasil',
                            text: 'Data jadwal berhasil disimpan',
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
                text: 'Apakah Anda yakin ingin menghapus data jadwal?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, Hapus',
                cancelButtonText: 'Batal'
            }).then(function(result) {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '/jadwal/' + id,
                        method: 'DELETE',
                        data: {
                            _token: $('input[name=_token]').val()
                        },
                        success: function(data) {
                            if (data.success) {
                                Swal.fire({
                                    title: 'Berhasil',
                                    text: 'Data jadwal berhasil dihapus',
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

        function filterJadwals(query) {
            $('.mb-3').each(function() {
                var jam = $(this).find('.font-14.mb-1').text().toLowerCase();
                var hari = $(this).find('.opacity-60.font-10.mb-0').text().toLowerCase();
                var kelas = $(this).find('.opacity-60.font-10.mb-0').text().toLowerCase();
                var guru = $(this).find('.opacity-60.font-10.mb-0').text().toLowerCase();
                var tahunAjaran = $(this).find('.opacity-60.font-10.mb-0').text().toLowerCase();
                var semester = $(this).find('.opacity-60.font-10.mb-0').text().toLowerCase();

                if (jam.includes(query) || hari.includes(query) || kelas.includes(query) || guru.includes(query) || tahunAjaran.includes(query) || semester.includes(query)) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
        }

        $('#searchInput').on('input', function() {
            var searchQuery = $(this).val().toLowerCase();
            filterJadwals(searchQuery);
        });

    });
</script>


@endsection
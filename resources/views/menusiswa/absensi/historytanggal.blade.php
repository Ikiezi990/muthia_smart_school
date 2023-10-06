@extends('templates.frontend')
@section('content')
<div class="card card-style">
    <div class="content">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="mb-3">History Absensi Pertanggal</h2>
        </div>
        <form action="{{ route('student.attendance') }}" method="post">
            @csrf
            <label for="jadwal_id" class="form-label">Jadwal</label>
            <select name="jadwal_id" id="jadwal_id" class="form-control">
                @foreach($jadwal as $row)
                <option value="{{ $row->id }}">{{ $row->mapel->nama_mapel }} - {{ $row->kelas->nama_kelas }}</option>
                @endforeach
            </select>
            <label for="tanggal_awal" class="form-label">Tanggal Awal</label>
            <input type="date" name="tanggal_awal" class="form-control" value="{{ date('Y-m-d') }}">
            <label for="tanggal_akhir" class="form-label">Tanggal Akhir</label>
            <input type="date" name="tanggal_akhir" class="form-control" value="{{ date('Y-m-d') }}">

            <!-- Move the Filter button to the right -->
            <button type="submit" class="btn btn-success mt-2 btn-block">Filter</button>
        </form>
        <table class="table table-stripped text-center mt-3">
            <thead>
                <tr>
                    <th colspan="4" class="bg-dark text-white">Status</th>
                </tr>
                <tr>
                    <th class="bg-success text-white">Hadir</th>
                    <th class="bg-danger text-white">Alpa</th>
                    <th class="bg-info text-white">Izin</th>
                    <th class="bg-warning text-white">Sakit</th>
                </tr>
            </thead>
            <tbody id="student-table-body">
                <!-- Student data will be inserted here via AJAX -->
            </tbody>
        </table>
    </div>
</div>

<!-- Display Student Attendance Data -->


<script>
    $(document).ready(function() {
        // Listen for the form submission
        $('form').submit(function(event) {
            event.preventDefault(); // Prevent the form from submitting

            // Show a SweetAlert2 preloader
            Swal.fire({
                title: 'Loading...',
                allowOutsideClick: false,

            });

            // Get the form data
            var formData = $(this).serialize();

            // Make an AJAX request to retrieve student data
            $.ajax({
                type: 'POST',
                url: "{{ route('student.attendance.siswa')}}", // Replace with your actual Laravel route
                data: formData,
                dataType: 'json',
                success: function(data) {
                    // Close the SweetAlert2 preloader
                    Swal.close();

                    // Clear any previous student data
                    $('#student-table-body').empty();
                    console.log(data);

                    // Loop through the student data and create table rows
                    $.each(data, function(index, student) {
                        var rowHtml = '<tr>' +
                            '<td><span class="badge bg-success text-white">' + student.hadir + '</span></td>' +
                            '<td><span class="badge bg-danger text-white">' + student.alpa + '</span></td>' +
                            '<td><span class="badge bg-info text-white">' + student.izin + '</span></td>' +
                            '<td><span class="badge bg-warning text-white">' + student.sakit + '</span></td>' +
                            '</tr>';
                        $('#student-table-body').append(rowHtml);
                    });
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                    // Close the SweetAlert2 preloader in case of an error
                    Swal.close();
                }
            });
        });
    });
</script>

@endsection
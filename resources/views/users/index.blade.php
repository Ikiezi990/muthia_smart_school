@extends('templates.frontend')

@section('content')
<div class="card card-style">
    <div class="content">
        <div class="d-flex justify-content-between">
            <h2>User Management</h2>
            <div class="d-flex justify-content-between">
                <button id="addUser" class="btn btn-primary"><i class="fa fa-plus"></i></button>
                <button id="refreshPage" class="btn btn-secondary"><i class="fa fa-refresh"></i></button>
            </div>
        </div>
        <input type="text" id="searchInput" class="form-control mb-2 mt-2" placeholder="Cari User">

        <div class="scrollable">
            <ul class="list-unstyled">
                @foreach ($users as $user)
                <li class="mb-3">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <h6 class="font-12 font-600 mb-1">{{ $user->name }}</h6>
                            <p class="opacity-60 font-10 mb-0">{{ $user->email }}</p>
                            <p class="opacity-60 font-10 mb-0">Role: {{ $user->is_admin }}</p>
                        </div>
                        <div>
                            <button class="btn btn-info edit" data-id="{{ $user->id }}">
                                <i class="fa fa-edit"></i>
                            </button>
                            <button class="btn btn-danger delete" data-id="{{ $user->id }}">
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
            <form id="userForm">
                @csrf
                <input type="hidden" id="userId">
                <div class="form-group">
                    <label for="name">Nama:</label>
                    <input type="text" class="form-control" id="name" required>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" id="email" required>
                </div>
                <div class="form-group">
                    <label for="role">Role:</label>
                    <select class="form-control" id="role" required>
                        <option value="guru">Guru</option>
                        <option value="siswa">Siswa</option>
                        <option value="admin">Admin</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="reference_id">NISN/NIP:</label>
                    <input type="text" class="form-control" id="reference_id">
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" class="form-control" id="password" required>
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

        $('#addUser').click(function() {
            $('#userId').val('');
            $('#name').val('');
            $('#email').val('');
            $('#role').val('');
            $('#reference_id').val('');
            $('#password').val('');
            $('.modal').css('display', 'block');
        });

        $('.close').click(function() {
            $('.modal').css('display', 'none');
        });

        $('.edit').click(function() {
            var id = $(this).data('id');
            $.ajax({
                url: '/users/' + id + '/edit',
                method: 'GET',
                success: function(data) {
                    $('#userId').val(data.id);
                    $('#name').val(data.name);
                    $('#email').val(data.email);
                    $('#role').val(data.is_admin);
                    $('#reference_id').val(data.reference_id);
                    $('#password').val('');
                    $('.modal').css('display', 'block');
                }
            });
        });

        $('#userForm').submit(function(e) {
            e.preventDefault();
            var id = $('#userId').val();
            var name = $('#name').val();
            var email = $('#email').val();
            var role = $('#role').val();
            var reference_id = $('#reference_id').val();
            var password = $('#password').val();
            var url = id ? '/users/' + id : '/users';

            $.ajax({
                url: url,
                method: id ? 'PUT' : 'POST',
                data: {
                    _token: $('input[name=_token]').val(),
                    name: name,
                    email: email,
                    is_admin: role,
                    password: password,
                    reference_id: reference_id,
                    password: password
                },
                success: function(data) {
                    if (data.success) {
                        Swal.fire({
                            title: 'Berhasil',
                            text: 'Data user berhasil disimpan',
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
                text: 'Apakah Anda yakin ingin menghapus data user?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, Hapus',
                cancelButtonText: 'Batal'
            }).then(function(result) {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '/users/' + id,
                        method: 'DELETE',
                        data: {
                            _token: $('input[name=_token]').val()
                        },
                        success: function(data) {
                            if (data.success) {
                                Swal.fire({
                                    title: 'Berhasil',
                                    text: 'Data user berhasil dihapus',
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

        function filterUsers(query) {
            $('.mb-3').each(function() {
                var userName = $(this).find('.font-14.mb-1').text().toLowerCase();
                var userEmail = $(this).find('.opacity-60.font-10.mb-0').text().toLowerCase();
                var userRole = $(this).find('.opacity-60.font-10.mb-0').text().toLowerCase();

                if (userName.includes(query) || userEmail.includes(query) || userRole.includes(query)) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
        }


        $('#searchInput').on('input', function() {
            var searchQuery = $(this).val().toLowerCase();
            filterUsers(searchQuery);
        });
    });
</script>

@endsection
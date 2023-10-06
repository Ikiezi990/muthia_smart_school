@extends('templates.frontend')
@section('content')
<div class="card card-style">
    <div class="content">
        <div class="text-center mb-4">
            <img src="{{ asset('logo.png') }}" alt="Your Logo" class="img-fluid" width="120px">
            <h3 class="mt-2">Selamat Datang Di Aplikasi Muthia Smart School</h3>
        </div>
        <form id="register-form" method="POST" action="{{ route('register') }}">
            @csrf

            <div class="form-group row">
                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>
                <div class="col-md-6">
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="off" autofocus>
                    <span class="invalid-feedback name-error" role="alert"></span>
                </div>
            </div>

            <div class="form-group row">
                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
                <div class="col-md-6">
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="off">
                    <span class="invalid-feedback email-error" role="alert"></span>
                </div>
            </div>

            <div class="form-group row">
                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>
                <div class="col-md-6">
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="off">
                    <span class="invalid-feedback password-error" role="alert"></span>
                </div>
            </div>

            <div class="form-group row">
                <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>
                <div class="col-md-6">
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="off">
                </div>
            </div>

            <div class="form-group row">
                <label for="refrence_id" class="col-md-4 col-form-label text-md-right">{{ __('Reference ID') }}</label>
                <strong style="color: red;" class="col-md-4 col-form-label text-md-right">Isi dengan Nisn atau NUPTK anda !</strong>
                <div class="col-md-6">
                    <input id="refrence_id" type="text" class="form-control @error('refrence_id') is-invalid @enderror" name="refrence_id" value="{{ old('refrence_id') }}" required autocomplete="off">
                    <span class="invalid-feedback refrence_id-error" role="alert"></span>
                </div>
            </div>

            <div class="form-group row mb-0">
                <div class="col-md-6 offset-md-4">
                    <a href="{{ route('login') }}" class="btn btn-link">Sudah memiliki akun? Login di sini</a>
                </div>
                <div class="col-md-12">

                    <button type="button" id="register-btn" class="btn btn-primary btn-block">
                        {{ __('Register') }}
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#register-btn').on('click', function() {
            var name = $('#name').val();
            var email = $('#email').val();
            var password = $('#password').val();
            var passwordConfirmation = $('#password-confirm').val();
            var refrenceId = $('#refrence_id').val();

            $.ajax({
                url: '{{ route("register") }}',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    name: name,
                    email: email,
                    password: password,
                    password_confirmation: passwordConfirmation,
                    refrence_id: refrenceId,
                },
                success: function(response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Registration Successful',
                        text: 'Your account has been registered!',
                        showConfirmButton: false,
                        timer: 1500
                    }).then(function() {
                        window.location.href = "{{ route('home') }}";
                    });
                },
                error: function(xhr) {
                    if (xhr.status === 422) {
                        var errors = xhr.responseJSON.errors;
                        var errorMessages = [];
                        $.each(errors, function(key, value) {
                            errorMessages.push(value[0]);
                        });
                        Swal.fire({
                            icon: 'error',
                            title: 'Registration Failed',
                            html: errorMessages.join('<br>'),
                            confirmButtonText: 'OK'
                        });
                    }
                }
            });
        });
    });
</script>

@endsection
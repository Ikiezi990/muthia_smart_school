@extends('templates.frontend')
@section('content')
<div class="card card-style">
    <div class="content">
        <div class="text-center mb-4">
            <img src="{{ asset('logo.png') }}" alt="Your Logo" class="img-fluid" width="120px">
            <h3 class="mt-2">Selamat Datang Di Aplikasi Muthia Smart School</h3>
        </div>
        <form id="login-form" method="POST" action="{{ route('login') }}">
            @csrf

            <div class="form-group row">
                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
                <div class="col-md-6">
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="off" autofocus>
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



            <div class="form-group row mb-0">
                <div class="col-md-12">
                    <button type="button" id="login-btn" class="btn btn-primary btn-block">
                        {{ __('Login') }}
                    </button>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-6 offset-md-4">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }} checked style="visibility: hidden;">
                        <label class="form-check-label" for="remember" style="visibility: hidden;">
                            {{ __('Remember Me') }}
                        </label>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#login-btn').on('click', function() {
            var email = $('#email').val();
            var password = $('#password').val();
            var remember = $('#remember').prop('checked');

            $.ajax({
                url: '{{ route("login") }}',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    email: email,
                    password: password,
                    remember: remember,
                },
                success: function(response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Login Successful',
                        text: 'You have been logged in!',
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
                            title: 'Login Failed',
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
@extends('layout.app')

@section('content')
<div class="container h-inherit">
    <div class="login-form h-inherit row justify-content-center m-auto">
        <div class="col m-auto">
            <div class="row text-center">
                <div class="col">
                    <img src="{{ asset('storage/img/logo.svg') }}" class="chrono-slack-logo img-fluid" alt="ChronoStep Logo">
                </div>
            </div>
            <div class="row text-center">
                <div class="col fw-semibold text-color p-2">
                    <span>CHRONOSLACK</span>
                </div>
            </div>
            <form action="{{ route('web.auth.login.post') }}" method="post">
                @csrf
                <div class="row p-2">
                    <label for="email" class="form-label fw-semibold text-color">Username / Email</label>
                    <div class="col">
                        <input type="text" class="input-radius form-control form-control-lg" name="email" id="email" value="{{ old('email') }}">
                        @error('email')
                        <div id="usernameHelpBlock" class="form-text text-center">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="row p-2">
                    <label for="password" class="form-label fw-semibold text-color">Password</label>
                    <div class="col">
                        <div class="input-container">
                            <input type="password" class="input-radius form-control form-control-lg" name="password" id="password">
                            <i class="bi bi-eye-slash password-toggle-icon p-2" id="show-password-toggle"></i>
                        </div>
                        @error('password')
                        <div id="passwordHelpBlock" class="form-text text-center">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                @if (session()->has('error'))
                <div id="sessionError" class="form-text text-center">{{ session('error') }}</div>
                @endif
                <div class="row text-center">
                    <div class="col my-2">
                        <a href="" class="fw-semibold text-color text-decoration-none">Forgot Password?</a>
                    </div>
                </div>
                <div class="row text-center p-2">
                    <div class="col">
                        <button type="submit" class="btn-login btn btn-primary">LOGIN</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

    {{-- <script>
        $(document).ready(function() {
            function verifyToken()
            {
                
            }

            $('#formLogIn').on('submit', function (e) {
                e.preventDefault();
                $.ajax({
                    type: 'POST',
                    url: $(this).attr('action'),
                    data: $(this).serialize(),
                    success: function(response) {
                        if (response.success) {
                            let data = response.data;
                            localStorage.setItem('userToken', data.token.plainTextToken)
                            window.location.href='/home';
                        }
                    }, error: function (error) {
                        console.log(error);
                    }
                })
            });
        })
    </script> --}}
@endsection

@extends('layouts.guest')

@section('title', 'Login')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-xl-10 col-lg-12 col-md-9">
            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <div class="row">
                        <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                        <div class="col-lg-6">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Selamat Datang!</h1>
                                </div>

                                <!-- Session Status -->
                                @if (session('status'))
                                    <div class="alert alert-success mb-4" role="alert">
                                        {{ session('status') }}
                                    </div>
                                @endif

                                <form class="user" method="POST" action="{{ route('login') }}">
                                    @csrf

                                    <!-- Email Address -->
                                    <div class="form-group">
                                        <input
                                            type="email"
                                            class="form-control form-control-user @error('email') is-invalid @enderror"
                                            id="email"
                                            name="email"
                                            value="{{ old('email') }}"
                                            placeholder="Masukkan Alamat Email..."
                                            required
                                            autofocus
                                            autocomplete="username">
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Password -->
                                    <div class="form-group">
                                        <input
                                            type="password"
                                            class="form-control form-control-user @error('password') is-invalid @enderror"
                                            id="password"
                                            name="password"
                                            placeholder="Password"
                                            required
                                            autocomplete="current-password">
                                        @error('password')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Remember Me -->
                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox small">
                                            <input
                                                type="checkbox"
                                                class="custom-control-input"
                                                id="remember_me"
                                                name="remember">
                                            <label class="custom-control-label" for="remember_me">
                                                Ingat Saya
                                            </label>
                                        </div>
                                    </div>

                                    <button type="submit" class="btn btn-primary btn-user btn-block">
                                        Login
                                    </button>
                                </form>

                                <hr>
                                <div class="text-center">
                                    @if (Route::has('password.request'))
                                        <a class="small" href="{{ route('password.request') }}">Lupa Password?</a>
                                    @endif
                                </div>
                                <div class="text-center">
                                    @if (Route::has('register'))
                                        <a class="small" href="{{ route('register') }}">Buat Akun Baru!</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

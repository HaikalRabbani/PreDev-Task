@extends('layouts.guest')

@section('title', 'Forgot Password')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-xl-10 col-lg-12 col-md-9">
            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <div class="row">
                        <div class="col-lg-6 d-none d-lg-block bg-password-image"></div>
                        <div class="col-lg-6">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-2">Lupa Password?</h1>
                                    <p class="mb-4">Kami mengerti, hal ini bisa terjadi! Masukkan email Anda di bawah ini dan kami akan mengirimkan link untuk mereset password Anda.</p>
                                </div>

                                <!-- Session Status -->
                                @if (session('status'))
                                    <div class="alert alert-success mb-4" role="alert">
                                        {{ session('status') }}
                                    </div>
                                @endif

                                <form class="user" method="POST" action="{{ route('password.email') }}">
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
                                            autofocus>
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <button type="submit" class="btn btn-primary btn-user btn-block">
                                        Kirim Link Reset Password
                                    </button>
                                </form>
                                <hr>
                                <div class="text-center">
                                    <a class="small" href="{{ route('register') }}">Buat Akun!</a>
                                </div>
                                <div class="text-center">
                                    <a class="small" href="{{ route('login') }}">Sudah punya akun? Login!</a>
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

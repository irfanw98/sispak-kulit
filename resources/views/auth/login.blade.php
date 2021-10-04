<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Sispak</title>

    <!-- Font Poppins -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Poppins&family=Roboto:wght@700&display=swap" rel="stylesheet" />
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('admin/assets/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/frontend/login/style.css') }}">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
</head>
<body>
    <div class="container-fluid login">
        <div class="row d-flex">
            <div class="col-sm-6 col-md-6 col-lg-6 mt-3 gambar-login">
                <a href="{{ url('/') }}" class="arrow"><i class="fas fa-arrow-circle-left"></i> Kembali</a>
                <img src="{{ asset('image/page-login.svg') }}" alt="ilustrasi-login">
                <p>Belum memiliki akun ? Yuk,
                    <span><a href="{{ route('register') }}" type="button" class="register">Daftar</a></span>
                </p>
            </div>
            <div class="col-sm-6 col-md-6 col-lg-6 form-login">
                <h1>Masuk</h1><hr>
                <form action="{{ route('login') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Alamat Email') }}</label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="off" autofocus placeholder="alamat@gmail.com">

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group password">
                        <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required  placeholder="Masukkan Password">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="row remember-forgot">
                        <div class="form-group">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                            <label class="form-check-label" for="remember">
                                {{ __('Ingat Saya') }}
                            </label>
                        
                            @if (Route::has('password.request'))
                            <a class="lupa-password" href="{{ route('password.request') }}">
                                {{ __('Lupa Password?') }}
                            </a>
                            @endif
                        </div>
                    </div>
                    <div class="form-group button">
                        <button type="submit" class="btn costum-btn">{{ __('Masuk') }} <i class="fas fa-sign-in-alt"></i></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="{{ asset('js/frontend/login/script.js') }}"></script>
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register | Sispak</title>

    <!-- Font Poppins -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Poppins&family=Roboto:wght@700&display=swap" rel="stylesheet" />
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('admin/assets/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/frontend/register/style.css') }}">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
</head>
<body>
    <div class="container-fluid register">
        <div class="row d-flex">
            <div class="col-sm-6 col-md-6 col-lg-6 mt-3 gambar-register">
                <a href="{{ url('/') }}" class="arrow"><i class="fas fa-arrow-circle-left"></i> Kembali</a>
                <img src="{{ asset('image/page-register.svg') }}" alt="ilustrasi-register">
            </div>
            <div class="col-sm-6 col-md-6 col-lg-6 form-register">
                <h1>Daftar</h1><hr>
                <form action="{{ route('register') }}" method="POST">
                    @csrf

                    <div class="form-group">
                        <label for="nama" class="col-md-4 col-form-label text-md-right">{{ __('Nama') }}</label>
                        <input id="nama" type="nama" class="form-control @error('nama') is-invalid @enderror" name="nama" value="{{ old('nama') }}" required autocomplete="off" autofocus>

                        @error('nama')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group pt-1">
                        <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Alamat Email') }}</label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="off" autofocus>

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group pt-1 password">
                        <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required>

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group pt-1">
                         <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Konfirmasi Password') }}</label>
                         <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="off">
                    </div>

                    <div class="form-group button">
                        <button type="submit" class="btn btn-register">{{ __('Buat Akun') }}</button>
                    </div>
                </form>
                <p>Sudah memiliki akun ? Yuk,
                    <span><a href="{{ route('login') }}" type="button" class="masuk">Masuk</a></span>
                </p>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="{{ asset('js/frontend/login/script.js') }}"></script>
</body>
</html>
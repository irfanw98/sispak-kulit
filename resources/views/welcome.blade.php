<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Sispak | Kulit</title>

        <!-- Font Roboto -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200&family=Roboto:wght@300&display=swap" rel="stylesheet">
        <!-- Font Poppins -->
        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
        <link href="https://fonts.googleapis.com/css2?family=Poppins&family=Roboto:wght@700&display=swap" rel="stylesheet" />
        <!-- Font Awesome -->
        <link rel="stylesheet" href="{{ asset('admin/assets/plugins/fontawesome-free/css/all.min.css') }}">
        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/frontend/style.css') }}">
        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
    </head>
    <body>
        <div class="scrollTop" onclick="scrollToTop()"></div>
        <nav>
            <div class="logo">
                <h1>
                    <img src="{{ asset('image/logo-kemkes.png') }}" width="50px" alt="logo-kemkes">
                    Sispaku.
                </h1>
            </div>

            <ul>
                <li><a href="">Beranda</a></li>
                <li><a href="">Langkah</a></li>
                <li><a href="">Tentang</a></li>
                @if (Route::has('login'))
                    @auth
                        @if(auth()->user()->hasRole("admin"))
                            <li><a href="{{ route('dashboard-admin') }}">Dashboard</a></li>
                        @elseif(auth()->user()->hasRole("dokter"))
                            <li><a href="{{ route('dashboard-dokter') }}">Dashboard</a></li>
                        @else
                            <li><a href="{{ route('dashboard-user') }}">Dashboard</a></li>
                        @endif
                    @else
                        <li><a href="{{ route('login') }}">Login</a></li>
                        @if (Route::has('register'))
                            <li><a href="{{ route('register') }}">Register</a></li>
                        @endif
                    @endauth
                @endif
            </ul>

            <div class="menu-toggle">
                <input type="checkbox">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </nav>

        <section class="hero">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 intro-hero">
                        <h1>Selamat Datang Di Sistem Pakar Penyakit Kulit</h1>
                        <p>Anda mengalami masalah pada kulit? Yuk, Konsultasi.</p>
                        <a href="{{ route('login') }}" type="button" class="btn btn-hero"><i class="fas fa-sign-in-alt"></i> Konsultasi</a>
                    </div>
                    <div class="col-md-6">
                        <img src="{{ asset('image/hero.svg') }}" alt="">
                    </div>
                </div>
            </div>
        </section>

        <section class="konsultasi">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-12 text-center">
                       <h2>
                            Langkah Mudah Sistem Pakar <br>
                            <span>Penyakit Kulit</span>
                       </h2>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6 col-md-6 col-lg-6 px-5 py-4">
                        <div class="img-langkah">
                            <img src="{{ asset('image/register.svg') }}" alt="langkah-resgistrasi">
                        </div>
                        <h4>Registrasi</h4>
                        <p>Langkah pertama registrasi agar mempunyai akun untuk berkonsultasi di sistem pakar ini.</p>
                    </div>
                    <div class="col-sm-6 col-md-6 col-lg-6 px-5 py-4 mt-lg-5">
                        <div class="img-langkah">
                            <img src="{{ asset('image/caraLogin.svg') }}" alt="langkah-login">
                        </div>
                        <h4>Login</h4>
                        <p>Langkah Kedua login menggunakan akun yang telah di registrasikan sebelumnya.</p>
                    </div>
                    <div class="col-sm-6 col-md-6 col-lg-6 px-5 py-4">
                        <div class="img-langkah">
                            <img src="{{ asset('image/konsultasi.svg') }}" alt="langkah-konsultasi">
                        </div>
                        <h4>Konsultasi</h4>
                        <p>Langkah ketiga pilih menu konsultasi dan masukkan gejala penyakit kulit yang anda rasakan.</p>
                    </div>
                    <div class="col-sm-6 col-md-6 col-lg-6 px-5 py-4 mt-lg-5">
                        <div class="img-langkah">
                            <img src="{{ asset('image/hasil.svg') }}" alt="langkah-hasil">
                        </div>
                        <h4>Hasil</h4>
                        <p>Langkah Keempat anda mendapatkan hasil diagnosa penyakit kulit dan solusinya.</p>
                    </div>
                </div>
            </div>
        </section>

        <section class="about">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-12">
                        <h1>
                            Apa itu
                            <span>Sistem Pakar ?</span> 
                        </h1>
                    </div>
                    <div class="col-sm-12 col-md-12 col-lg-12">
                        <blockquote>
                            <p>
                                "Sistem Pakar <span>(Expert System)</span> merupakan sistem berbasis komputer yang menggunakan pengetahuan seorang pakar dalam memecahkan masalah dalam bidang tersebut, sehingga dapat digunakan untuk berkonsultasi."
                            </p>
                        </blockquote>
                    </div>
                </div>
            </div>
        </section>

        <section class="footer">
            <div class="container">
                <div class="row">
                     <div class="col-sm-6 col-md-6 col-lg-6 mt-4">
                        <h4>&copy;Copyright @2021 Sistem Pakar | Irfan Wahyudi </h4>
                    </div>
                    <div class="col-sm-6 col-md-6 col-lg-6 mt-3 sosmed">
                        <a href="mailto:irfanwahyudi2016@gmail.com" target="_blank">
                            <img src="{{ asset('image/email.svg') }}" alt="email" width="30px">
                        </a>
                        <a href="https://wa.me/+6289655591519" target="_blank">
                            <img src="{{ asset('image/whatsapp.svg') }}" alt="whastsapp" width="40px">
                        </a>
                        <a href="https://t.me/irfanw98" target="_blank">
                            <img src="{{ asset('image/telegram.svg') }}" alt="telegram" width="30px">
                        </a>
                        <a href="https://github.com/irfanw98" target="_blank">
                            <img src="{{ asset('image/github.svg') }}" alt="github" width="30px">
                        </a>
                    </div>
                </div>
        </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="{{ asset('js/frontend/script.js') }}"></script>
    <script type="text/javascript">
        const scrolls = document.querySelector(".scrollTop");
        
        window.addEventListener("scroll", function () {
            scrolls.classList.toggle("aktif", window.scrollY > 500);
        });

        function scrollToTop() {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        }
    </script>
    </body>
</html>

@extends('template.master')

@section('tittle', 'Tentang Penyakit Kulit')

@section('header')
    <style>
        .judul-artikel{
            font-weight: bold;
        }
        .img-artikel{
            width: 400px;
            margin-top: 10px;
        }
        .sumber-gambar{
            font-size: 12px;
        }
        .isi-artikel{
            text-indent: 30px;
            text-align:justify;
        }
        .sumber-artikel{
            font-size: 14px;
            font-style: italic;
        }    
    </style>
@endsection


@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            </div>
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('dashboard-user') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">Tentang Penyakit Kulit</li>
            </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
<section class="content">
    <div class="row">
        <div class="col-lg-12 text-center judul-artikel">
            <h4>Segala Yang Perlu Anda Ketahui Seputar Penyakit Kulit</h4>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 text-center">
            <img src="{{ asset('image/penyakit-kulit.jpg') }}" alt="penyakit kulit" class="img-artikel">
            <p class="sumber-gambar">Sumber: iStock</p>
        </div>
   </div>
   <div class="row">
       <div class="container">
           <div class="col-lg-12">
               <p class="isi-artikel">
                    Penyakit kulit adalah kondisi saat lapisan luar tubuh mengalami masalah baik iritasi atau meradang. Penyakit ini terdiri dari berbagai jenis yang bervariasi, masing-masing memiliki gejala yang berbeda-beda pula.
               </p>
               <p class="isi-artikel">
                    Penyakit kulit bisa disebabkan oleh berbagai hal, meliputi faktor kebersihan diri, paparan dari zat berbahaya di lingkungan, infeksi, sampai masalah pada imunitas seperti alergi. Ada beberapa penyakit kulit yang berbahaya, ada juga penyakit kulit yang ringan namun dapat mengganggu penampilan.Sebagian penyakit bersifat sementara, sedangkan sebagian lainnya bisa permanen dan terus-menerus kambuh.
               </p>
               <p class="sumber-artikel">
                   Sumber: <a href="https://hellosehat.com/penyakit-kulit/pengertian-penyakit-kulit/" target="_blank">https://hellosehat.com/penyakit-kulit/pengertian-penyakit-kulit/</a>
               </p>
           </div>
       </div>
   </div>
</section>

@endsection

@section('footer')
@endsection

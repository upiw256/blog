<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>@yield('title')</title>
    <meta content="ini website SMAN 1 Margaasih" name="description">
    <meta content="Informasi seputar SMAN 1 Margaasih" name="keywords">
    <base href="/" />
    <!-- Favicons -->
    <link href="{{ asset('/') }}assets/img/favicon.png" rel="icon">
    <link href="{{ asset('/') }}assets/img/apple-touch-icon.png" rel="apple-touch-icon">
    @vite('resources/css/app.css')
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- pendor CSS Files -->
    <link href="{{ asset('/') }}assets/pendor/aos/aos.css" rel="stylesheet">
    <link href="{{ asset('/') }}assets/pendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('/') }}assets/pendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="{{ asset('/') }}assets/pendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="{{ asset('/') }}assets/pendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="{{ asset('/') }}assets/pendor/remixicon/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>

    <!-- Template Main CSS File -->
    <link href="{{ asset('/') }}assets/css/style.css" rel="stylesheet">
    @livewireStyles
    <!-- =======================================================
  * Template Name: Gp
  * Updated: Nov 25 2023 with Bootstrap v5.3.2
  * Template URL: https://bootstrapmade.com/gp-free-multipurpose-html-bootstrap-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
    <style>
        .bg-custom {
            background-color: #EFEFEF; /* Warna AFAFAF */
        }
        .swiper-pagination-bullet {
            background-color: orange;
            width: 15px; /* Lebar titik */
            height: 15px; /* Tinggi titik */
            /* Atau, jika Anda ingin titik menjadi lingkaran */
            border-radius: 50%; /* Mengubah warna latar belakang titik */
        }
        .news-wrapper {
        display: flex;
        }

        .news-slide {
            flex: 0 0 33.3333%;
            max-width: 33.3333%;
        }
        .swiper-container-acivements{
            width: 80%;
            height: 80%;
        }
        .btn-primary {
            background-color: #FFC451 !important;
            border-color: #FFC451 !important;
        }

        .btn-warning:hover {
            color: black !important;
            background-color: #FFC451 !important;
            border-color: #FFC451 !important;
        }

        .card {
            height: 30rem;
            width: 100%;
        }

        .card img {
            height: 30%;
        }

        .putih {
            background-color: white;
            padding-left: 10px;
        }
        .pagination .page-link {
        color: white;
        background-color: orange;
        margin-left: 5px;
        margin-right: 5px
        }
        .pagination .page-item.active .page-link {
            color: orange;
            background-color: white;
            border-color: orange;
        }

        .pagination .page-link:hover {
        color: orange;
        background-color: white
        }

        .counts .image {
        background: url({{ isset($kepsek->image) ? asset('storage/' . $kepsek->image) : '' }}) center center no-repeat;
        background-size: cover;
        min-height: 400px;
        }
        ol {
        list-style-type: decimal;
        }
        ul {
            list-style-type: disc;
        }
        blockquote {
    margin: 0;
    padding: 20px;
    background-color: #f9f9f9;
    border-left: 5px solid #333;
    font-style: italic;
}

blockquote p {
    margin: 0;
    padding: 0;
}

blockquote:before {
    content: open-quote;
    font-size: 4em;
    color: #333;
    line-height: 0.1em;
    margin-right: 0.25em;
}

blockquote:after {
    content: close-quote;
    font-size: 4em;
    color: #333;
    line-height: 0.1em;
    margin-left: 0.25em;
    vertical-align: -0.4em;
}
.card-container {
    display: flex;
}

.card {
    margin-right: 10px; /* Jarak antara kartu */
}


    </style>
</head>

<body class="bg-custom">
    <!-- ======= Header ======= -->
    <header id="header" class="fixed-top header-inner-pages">
        <div class="container d-flex align-items-center justify-content-lg-between">

            <h1 class="logo me-auto me-lg-0"><a href="/">M<span>.</span>G<span>.</span>A</a></h1>
            <!-- Uncomment below if you prefer to use an image logo -->
            <!-- <a href="index.html" class="logo me-auto me-lg-0"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->

            <nav id="navbar" class="navbar order-last order-lg-0">
                <ul>
                    <li><a class="nav-link scrollto active" href="#hero">Home</a></li>
                    <li><a class="nav-link scrollto" href="#news">News</a></li>
                    <li class="dropdown"><a href="#"><span>Informasi Sekolah</span> <i class="bi bi-chevron-down"></i></a>
                    <ul>
                        <li><a class="nav-link scrollto" href="#visimisi">Visi & Misi</a></li>
                        <li><a class="nav-link scrollto" href="#ekstra">Ekstra kulikuler</a></li>
                        <li><a class="nav-link scrollto" href="#guru">Data Guru</a></li>
                        <li><a class="nav-link scrollto " href="#achievement">Achievement</a></li>
                        <li><a class="nav-link scrollto " href="#kepsek">Profile Kepsek</a></li>
                        <li><a class="nav-link scrollto" href="#team">Team Management</a></li>
                    </ul>
                </li>
                <li><a class="nav-link scrollto" href="#about">About</a></li>
                    <li><a class="nav-link scrollto" href="#contact">Contact</a></li>
                </ul>
                <i class="bi bi-list mobile-nav-toggle"></i>
            </nav><!-- .navbar -->

        </div>
    </header><!-- End Header -->
        @yield('content')
        @include('layout.footer')
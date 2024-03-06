@extends('layout.header')

@section('title', 'Home')
@section('content')
  <!-- ======= Hero Section ======= -->
    <section id="hero" class="d-flex align-items-center justify-content-center">
        <div class="container" data-aos="fade-up">

            <div class="row justify-content-center" data-aos="fade-up" data-aos-delay="150">
                <div class="col-xl-6 col-lg-8">
                    <h1>SMAN 1 MARGAASIH<span>.</span></h1>
                    <h2>Magnificient, Good, Amazing</h2>
                </div>
            </div>

            <div class="row gy-4 mt-5 justify-content-center" data-aos="zoom-in" data-aos-delay="250">
                <div class="col-xl-2 col-md-4">
                    <div class="icon-box">
                        <i class="bi bi-backpack2"></i>
                        <h3><a href="">Jumlah Siswa</a></h3>
                        <h3><a href="">{{$student}}</a></h3>
                    </div>
                </div>
                <div class="col-xl-2 col-md-4">
                    <div class="icon-box">
                        <i class="i bi-person-badge"></i>
                        <h3><a href="">Jumlah Guru</a></h3>
                        <h3><a href="">{{$teacher}}</a></h3>
                    </div>
                </div>
                
                <div class="col-xl-2 col-md-4">
                    <div class="icon-box">
                        <i class="bi bi-building"></i>
                        <h3><a href="">Ruang Kelas</a></h3>
                        <h3><a href="">32</a></h3>
                    </div>
                </div>
                <div class="col-xl-2 col-md-4">
                    <div class="icon-box">
                        <i class="bi bi-person-video2"></i>
                        <h3><a href="">Jumlah Rombel</a></h3>
                        <h3><a href="">{{$classRoom}}</a></h3>
                    </div>
                </div>
            </div>
        </div>
    </section><!-- End Hero -->

    <main id="main">

        <!-- ======= About Section ======= -->
        @include('layout.content.Section.about')
        <!-- End About Section -->

        <!-- ======= news Section ======= -->
        @include('layout.content.Section.news')
        <!-- End Clients Section -->

        <!-- ======= visimisi Section ======= -->
        @include('layout.content.Section.visimisi')
        <!-- End Features Section -->

        <!-- ======= ekstra Section ======= -->
        @include('layout.content.Section.extra')
        <!-- End Services Section -->

        <!-- ======= guru Section ======= -->
        @include('layout.content.Section.guru')
        <!-- End Cta Section -->

        <!-- ======= achievement Section ======= -->
        @include('layout.content.Section.achievement')
        <!-- End Portfolio Section -->

        <!-- ======= kepsek Section ======= -->
        @include('layout.content.Section.kepsek')
        <!-- End Counts Section -->

        <!-- ======= Testimonials Section ======= -->
        <section id="testimonials" class="testimonials">
            <div class="container" data-aos="zoom-in">
                <div class="testimonial-item">
                    
                    <p>
                        <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                        SMAN 1 Margaasih Kabupaten Bandung Jawa Barat mempunyai visi, mewujudkan peserta didik yang religius dalam akademik dan non akademik serta berprestasi dalam kejuaraan dengan menguasai TIK dan berwawasan lingkungan. Maka dari visi ini kami buat motto, MGA, Magnificent, Good, Amazing. Magnificetn dalam akademik, Good dalam karakter, dan Amazing dalam prestasi.
                        <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                    </p>
                </div>

            </div>
        </section><!-- End Testimonials Section -->

        <!-- ======= Team Section ======= -->
        @include('layout.content.Section.team')
        
       <!-- End Team Section -->

        <!-- ======= Contact Section ======= -->
        <section id="contact" class="contact">
            <div class="container" data-aos="fade-up">

                <div class="section-title">
                    <h2>Contact</h2>
                    <p>Contact Us</p>
                </div>

                <div>
                    <iframe style="border:0; width: 100%; height: 270px;" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3960.3226338560617!2d-6.971270426522149!3d107.54887144226623!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68ef1fc525d5cf%3A0x17d04e35507b0d42!2sSMAN%201%20Margaasih!5e0!3m2!1sid!2sid!4v1703694859117!5m2!1sid!2sid" frameborder="0" allowfullscreen></iframe>
                </div>

                <div class="row mt-5">
                    <div class="col-lg-4 bg-custom">
                        <div class="info">
                            <div class="address">
                                <i class="bi bi-geo-alt"></i>
                                <h4>Location:</h4>
                                <p>
                                    sekolah
                                </p>
                            </div>

                            <div class="email">
                                <i class="bi bi-envelope"></i>
                                <h4>Email:</h4>
                                <p>
                                    email
                                </p>
                            </div>

                            <div class="phone">
                                <i class="bi bi-phone"></i>
                                <h4>Call:</h4>
                                <p>
                                    tlp
                                </p>
                            </div>

                        </div>

                    </div>

                    <div class="col-lg-8 mt-5 mt-lg-0 p-3 ">

                        @livewire('contact')

                    </div>

                </div>

            </div>
        </section><!-- End Contact Section -->

    </main><!-- End #main -->
    @endsection
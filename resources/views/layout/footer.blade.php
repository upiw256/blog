  <!-- ======= Footer ======= -->
  <footer id="footer">
    <div class="footer-top">
        <div class="container">
            <div class="row">

                <div class="col-lg-7 col-md-6">
                    <div class="footer-info">
                        <h3>M<span>.</span>G<span>.</span>A</h3>
                        <p>
                            Jl. Terusan TKI III No. 3 <br>
                            Kode Pos 40218, Bandung<br><br>
                            <strong>Phone:</strong> 88887445<br>
                            <strong>Email:</strong> admin@sman1mga.sch.id<br>
                        </p>
                        <div class="social-links mt-3">
                            <a href="#" class="twitter"><i class="bx bxl-twitter"></i></a>
                            <a href="#" class="facebook"><i class="bx bxl-facebook"></i></a>
                            <a href="#" class="instagram"><i class="bx bxl-instagram"></i></a>
                            <a href="#" class="google-plus"><i class="bx bxl-skype"></i></a>
                            <a href="#" class="linkedin"><i class="bx bxl-linkedin"></i></a>
                        </div>
                    </div>
                </div>


                <div class="col-lg-5 col-md-6 footer-newsletter">
                    <h4>Our Newsletter</h4>
                    <p>Tamen quem nulla quae legam multos aute sint culpa legam noster magna</p>
                    <form action="" method="post">
                        <input type="email" name="email"><input type="submit" value="Subscribe">
                    </form>

                </div>

            </div>
        </div>
    </div>

    <div class="container">
        <div class="copyright">
            &copy; Copyright <strong><span>SMAN 1 Margaasih</span></strong>. All Rights Reserved
        </div>
        <div class="credits">
            Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
        </div>
    </div>
</footer><!-- End Footer -->

<div id="preloader"></div>
<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
@vite('resources/js/app.js')
<!-- pendor JS Files -->
<script src="{{ asset('/') }}assets/pendor/purecounter/purecounter_vanilla.js"></script>
<script src="{{ asset('/') }}assets/pendor/aos/aos.js"></script>
<script src="{{ asset('/') }}assets/pendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('/') }}assets/pendor/glightbox/js/glightbox.min.js"></script>
<script src="{{ asset('/') }}assets/pendor/isotope-layout/isotope.pkgd.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
{{-- <script src="https://www.google.com/recaptcha/api.js"></script> --}}
{{-- <script src="https://www.google.com/recaptcha/api.js?render=6LdaKXcpAAAAAEOTf6IfGJaep0gX-t449_qf2FW2"></script> --}}
{{-- @stack('scripts') --}}
{{-- <script src="{{ asset('/') }}assets/pendor/php-email-form/validate.js"></script> --}}
@livewireScripts
<!-- Template Main JS File -->
<script src="{{ asset('/') }}assets/js/main.js"></script>
@stack('scripts')
<script>
    var swiper = new Swiper('.swiper-container-news', {

        breakpoints: {
            // Ketika lebar layar >= 1200px
            1200: {
                slidesPerView: 3,
            },
            // Ketika lebar layar < 1200px
            0: {
                slidesPerView: 1,
            },
        },
        spaceBetween: 10,
        pagination: {
            el: '.swiper-pagination-news',
            clickable: true,
        },
        autoplay: {
            delay: 3000, // Delay between slides in milliseconds (3 seconds in this example)
            disableOnInteraction: false,
        },
        loop: true,
    });
    const swiper2 = new Swiper('.swiper', {
    // Swiper options (customize based on your requirements)
    slidesPerView: 1,
    breakpoints: {
        // Ketika lebar layar <= 768px
        768: {
            slidesPerView: 3,
            spaceBetween: 20,
        },
    },
    spaceBetween: 10,
    loop: true,
    autoplay: {
        delay: 3000,
    },
    pagination: {
        el: '.swiper-pagination',
        clickable: true,
    },
});
    
</script>

</body>

</html>
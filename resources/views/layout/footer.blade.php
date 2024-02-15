  <!-- ======= Footer ======= -->
  <footer id="footer">
    <div class="footer-top">
        <div class="container">
            <div class="row">

                <div class="col-lg-3 col-md-6">
                    <div class="footer-info">
                        <h3>Gp<span>.</span></h3>
                        <p>
                            A108 Adam Street <br>
                            NY 535022, USA<br><br>
                            <strong>Phone:</strong> +1 5589 55488 55<br>
                            <strong>Email:</strong> info@example.com<br>
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

                <div class="col-lg-2 col-md-6 footer-links">
                    <h4>Useful Links</h4>
                    <ul>
                        <li><i class="bx bx-chevron-right"></i> <a href="#">Home</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="#">About us</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="#">Services</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="#">Terms of service</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="#">Privacy policy</a></li>
                    </ul>
                </div>

                <div class="col-lg-3 col-md-6 footer-links">
                    <h4>Our Services</h4>
                    <ul>
                        <li><i class="bx bx-chevron-right"></i> <a href="#">Web Design</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="#">Web Development</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="#">Product Management</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="#">Marketing</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="#">Graphic Design</a></li>
                    </ul>
                </div>

                <div class="col-lg-4 col-md-6 footer-newsletter">
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
            &copy; Copyright <strong><span>Gp</span></strong>. All Rights Reserved
        </div>
        <div class="credits">
            <!-- All the links in the footer should remain intact. -->
            <!-- You can delete the links only if you purchased the pro version. -->
            <!-- Licensing information: https://bootstrapmade.com/license/ -->
            <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/gp-free-multipurpose-html-bootstrap-template/ -->
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
<script src="{{ asset('/') }}assets/pendor/php-email-form/validate.js"></script>
@livewireScripts
<!-- Template Main JS File -->
<script src="{{ asset('/') }}assets/js/main.js"></script>
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
    var swiper_galery = new Swiper('.swiper-container-galery', {
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
            el: '.swiper-pagination-galery',
            clickable: true,
        },
        autoplay: {
            delay: 1000, // Delay between slides in milliseconds (3 seconds in this example)
            disableOnInteraction: false,
        },
        loop: true,
    });
</script>

</body>

</html>
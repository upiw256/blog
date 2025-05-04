<section id="news" class="clients">
    <div class="container" data-aos="zoom-in">
        <div class="section-title" data-aos="fade-up">
            <h2>News</h2>
            <p>News Update</p>
        </div>
        <div class="row">
            <div class="col-12">
                <form action="{{ route('search') }}" method="GET">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Search News" aria-label="Recipient's username" aria-describedby="button-addon2" name="query">
                        <button class="btn btn-primary" type="submit" id="button-addon2"><i class='bx bx-search-alt-2'></i></button>
                    </div>
                </form>
            </div>
        </div>
        <!-- Slider main container -->
        <div class="swiper-container swiper-container-news">
            <div class="swiper-wrapper">
            @if(isset($article) && count($article) > 0)
                @foreach($article as $art)
                <div class="swiper-slide" style="padding: 10px;"> <!-- Tambahkan padding di sini -->
                    <div class="col-12 d-flex align-items-stretch bg-light p-3 rounded" style="min-height: 300px;">
                    <div class="member" data-aos="fade-up" data-aos-delay="100">
                        <div class="member-img" style="width: 100%; height: 200px; overflow: hidden;"> <!-- Tinggi tetap -->
                            <img src="{{ asset('/') }}storage/{{$art->image}}" class="img-fluid" alt="" style="width: 100%; height: 100%; object-fit: cover;"> <!-- Gambar proporsional -->
                        </div>
                        <div class="member-info mt-3">
                            <h4><a href="{{ route('article.show', $art->slug) }}" class="text-primary">{{$art->title}}</a></h4>
                            <span>{!! Str::limit($art->content, 150) !!}</span>
                            <span><a href="{{ route('article.show', $art->slug) }}" class="btn btn-primary mt-2">Read More</a></span>
                        </div>
                    </div>
                    </div>
                </div>
                @endforeach
            @else
                <p>Maaf, belum ada artikel yang tersedia. Silakan cek kembali nanti.</p>
            @endif
            </div>
            <!-- Add Pagination -->
            <div class="swiper-pagination swiper-pagination-news"></div>
            <!-- Add Navigation -->
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>
    </div>
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script> <!-- Tambahkan Swiper JS -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            if (document.querySelector('.swiper-container-news')) {
                new Swiper('.swiper-container-news', {
                    slidesPerView: 1, // Tampilkan 1 slide penuh
                    spaceBetween: 0, // Tidak ada jarak antar slide
                    loop: true, // Aktifkan loop untuk kembali ke awal setelah slide terakhir
                    navigation: {
                        nextEl: '.swiper-button-next',
                        prevEl: '.swiper-button-prev',
                    },
                    pagination: {
                        el: '.swiper-pagination-news',
                        clickable: true,
                    },
                });
            } else {
                console.error('Swiper container not found.');
            }
        });
    </script>
</section>

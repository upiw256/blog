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
                <div class="swiper-container-news">
                    <div class="swiper-wrapper">
                        {{-- @dd($article) --}}
                        @if(isset($article) && count($article) > 0)
                            <!-- Tampilkan artikel -->
                            @foreach($article as $art)
                                <div class="col-12 col-sm-6 col-lg-4 d-flex align-items-stretch" data-aos="fade-up">
                                    <div class="card">
                                        <img src="{{ asset('storage/' . $art->image) }}" class="card-img-top" alt="{{ $art->title }}">
                                        <div class="card-header">
                                            <h4 class="card-title"><a href="{{ route('article.show', $art->slug) }}">{{$art->title}}</a></h4>
                                        </div>
                                        <div class="card-body">
                                            <p class="card-text">{!! Str::limit($art->content, 150) !!}</p>
                                            <a href="{{ route('article.show', $art->slug) }}" class="btn btn-primary">Read More</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <!-- Tampilkan pesan jika artikel belum ada -->
                            <p>Maaf, belum ada artikel yang tersedia. Silakan cek kembali nanti.</p>
                        @endif
                        <!-- Tambah slide tambahan sesuai kebutuhan -->
                    </div>
                    <div class="container-fluid d-flex justify-content-center">
                        <div class="row">
                          <div class="col-12">
                            <div class="mx-auto"><div class="mt-3 swiper-pagination-news"></div></div>
                          </div>
                        </div>
                    </div>
                </div>
</section>
<section id="achievement" class="portfolio">
            <div class="container" data-aos="fade-up">

                <div class="section-title">
                    <h2>Achievement</h2>
                    <p>Check our achievement</p>
                </div>

                <div class="row" data-aos="fade-up" data-aos-delay="100">
                    <div class="col-lg-12 d-flex justify-content-center">
                        <ul id="portfolio-flters">
                            <li data-filter="*" class="filter-active">All</li>
                            <li data-filter=".filter-Academic">Akademik</li>
                            <li data-filter=".filter-non-academic">Non Akademik</li>
                        </ul>
                    </div>
                </div>

                <div class="row portfolio-container" data-aos="fade-up" data-aos-delay="200">
                    @foreach($achievenent as $achievenent)
                    <div class="col-lg-4 col-md-6 portfolio-item filter-{{$achievenent->category}}">        
                        <div class="section-title">
                            <h2>{{ $achievenent->name }}</h2>
                        </div>
                        
                        <div class="portfolio-wrap">
                            @if(Str::startsWith($achievenent->img, 'http'))
                                <img src="{{ $achievenent->img }}" alt="Image" style="width: 30%; height: 30%;" class="rounded mx-auto d-block">
                            @else
                                <img src="{{ asset('storage/' . $achievenent->img) }}" alt="Image" style="width: 30%; height: 30%;" class="rounded mx-auto d-block">
                            @endif 
                            <div class="portfolio-info">
                                <p>{{ $achievenent->name }}</p>
                                <div class="portfolio-links">
                                    @if(Str::startsWith($achievenent->img, 'http'))
                                        <a href="{{ $achievenent->img }}" data-gallery="portfolioGallery" class="portfolio-lightbox" title="{{ $achievenent->name }}"><i class="bx bx-plus"></i></a>
                                    @else
                                        <a href="{{ asset('storage/' . $achievenent->img) }}" data-gallery="portfolioGallery" class="portfolio-lightbox" title="{{ $achievenent->name }}"><i class="bx bx-plus"></i></a>
                                    @endif
                                        <a href="{{route('achievement',$achievenent->id)}}" title="More Details"><i class="bx bx-link"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

            </div>
        </section>
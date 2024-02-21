<section id="ekstra" class="services">
            <div class="container" data-aos="fade-up">

                <div class="section-title">
                    <h2>Extracurricular</h2>
                    <p>Check our extracurricular</p>
                </div>

                <div class="swiper">
    <div class="swiper-wrapper">
        @foreach ($extras as $extra)
            <div class="swiper-slide">
                <div class="icon-box mx-3 my-3">
                    <a class="text-dark" href="{{ route('extra', $extra->id) }}">
                        <div class="icon"><img src="{{ asset('/') }}storage/{{$extra->logo}}" alt=""></div>
                        <h4>{{$extra->name}}</h4>
                        <p class="">{!!Str::words($extra->description, 5, '...')!!}</p>
                    </a>
                </div>
            </div>
        @endforeach
    </div>
    <div class="swiper-pagination"></div>
</div>

            </div>
        </section>
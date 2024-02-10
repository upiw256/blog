@extends('layout.header')

@section('title', 'Search Results')
@section('content')
        <!-- ======= Services Section ======= -->
        <section id="" class="services mt-5">
            <div class="container" data-aos="fade-up">

                <div class="section-title">
                    <h2>Search Results</h2>
                    <p>Hasil Pencarian untuk "{{ $query }}"</p>
                </div>
                @if($articles->count() > 0)
                <div class="row">
                    @foreach($articles as $article)
                    <div class="col-lg-4 col-md-6 d-flex align-items-stretch" data-aos="zoom-in" data-aos-delay="100">
                        <div class="icon-box">
                            <div class="icon"><img src="{{ asset('/') }}storage/{{$article->image}}" alt="{{$article->image}}"></div>
                            <h4 class="mt-2"><a href="{{ route('article.show', $article->id) }}">{{$article->title}}</a></h4>
                            <p>{!! Str::limit($article->content, 100) !!}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
                @else
                <h2>Hasil Tidak Ditemuka</h2>
                @endif
            </div>
        </section><!-- End Services Section -->
@endsection
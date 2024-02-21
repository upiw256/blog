@extends('layout.header')

@section('title', 'Article')
@section('content')
<main id="main">
    <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs">
      <div class="container">
        <div class="d-flex justify-content-end align-items-center">
          <ol>
            <li><a href="/">Home</a></li>
            <li>Article {{$article->title}}</li>
          </ol>
        </div>
          <h1>{{$article->title}}</h1>
      </div>
    </section><!-- End Breadcrumbs -->

<!-- ======= Portfolio Details Section ======= -->
    <section id="portfolio-details" class="portfolio-details">
      <div class="container">
        <div class="col-lg-12">
        @if(Str::startsWith($article->image, 'http'))
            <img src="{{ $article->image }}" alt="Image" style="width: 30%; height: 30%;" class="rounded mx-auto d-block">
        @else
            <img src="{{ asset('storage/' . $article->image) }}" alt="Image" style="width: 30%; height: 30%;" class="rounded mx-auto d-block">
        @endif          

            <p><em>Created by: {{$article->user->name}}</em></p>
            <p><em>{{$article->updated_at->format('Y-m-d')}}</em></p>
          </div>

          <div class="col-lg-12">
            <div class="portfolio-description">
              <p>
                {!! $article->content !!}
              </p>
            </div>
          </div>

      </div>
    </section><!-- End Portfolio Details Section -->

</main><!-- End #main -->  
@endsection

  

@extends('layout.header')

@section('title', 'Graduations')
@section('content')
<main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs">
      <div class="container">

        <div class="d-flex justify-content-end align-items-center">
          <ol>
            <li><a href="/">Home</a></li>
            <li>Graduations</li>
          </ol>
        </div>
          <h1>Graduations</h1>
      </div>
    </section><!-- End Breadcrumbs -->

    <!-- ======= Graduation Search Section ======= -->
    <section id="graduation-search" class="graduation-search">
      <div class="container">
        <div class="col-lg-12">
            @livewire('search-graduation')
        </div>
      </div>
    </section><!-- End Graduation Search Section -->

</main><!-- End #main --> 
@endsection

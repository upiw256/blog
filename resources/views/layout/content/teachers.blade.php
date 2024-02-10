@extends('layout.header')

@section('title', 'Teachers')
@section('content')
<main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs">
      <div class="container">

        <div class="d-flex justify-content-end align-items-center">
          <ol>
            <li><a href="/">Home</a></li>
            <li>Teachers</li>
          </ol>
        </div>
          <h1></h1>
      </div>
    </section><!-- End Breadcrumbs -->

<!-- ======= Portfolio Details Section ======= -->
    <section id="portfolio-details" class="portfolio-details">
      <div class="container">
        <div class="col-lg-12">
            <livewire:search-teacher />
      </div>
    </section><!-- End Portfolio Details Section -->

</main><!-- End #main --> 
@endsection
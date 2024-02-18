@extends('layout.header')

@section('title', 'Extra')
@section('content')
<main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs">
      <div class="container">

        <div class="d-flex justify-content-end align-items-center">
          <ol>
            <li><a href="/">Home</a></li>
            <li>Ekstra kulikuler</li>
          </ol>
        </div>
          <h1></h1>
      </div>
    </section><!-- End Breadcrumbs -->

<!-- ======= Portfolio Details Section ======= -->
    <section id="portfolio-details" class="portfolio-details">
      <div class="container">
        <div class="section-title">
            <h2>Extracurricular</h2>
            <p>- {{ $id->name }} -</p>
        </div>
        <div class="col-lg-12">
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <th scope="row">Nama</th>
                        <td><b>{{ $id->name }}</b></td>
                    </tr>
                    <tr>
                        <th scope="row">Logo</th>
                        <td><img src="{{ asset('/') }}storage/{{ $id->logo }}" alt="" width="50"></td>
                    </tr>
                    <tr>
                        <th scope="row">Deskripsi</th>
                        <td>{!! $id->description !!}</td>
                    </tr>
                    <tr>
                        <th scope="row">Jumlah Member</th>
                        <td>{!! $member !!}</td>
                    </tr>
                    <tr>
                        <th scope="row">Anggota</th>
                        <td> 
                            <ul>
                                @foreach($students as $student)
                                    <li>- {{ $student->student->nama }}</li>
                                @endforeach
                        </ul>
                        <td>
                    </tr>
                    
                </tbody>
            </table>
      </div>
    </section><!-- End Portfolio Details Section -->

</main><!-- End #main --> 
@endsection
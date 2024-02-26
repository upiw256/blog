@extends('layout.header')

@section('title', 'Achivements')
@section('content')
<main id="main" class="counts my-5 py-5">
    <div class="container" data-aos="fade-up">
        <div class="section-title">
            <h2>profile</h2>
            <p>Achivements</p>
        </div>
        <div class="row no-gutters">
          <div class="col-xl-5 d-flex justify-content-center justify-content-lg-start"  data-aos="fade-right" data-aos-delay="100">
            <div class="swiper-container-acivements">
              <div class="swiper-wrapper">
                  @foreach ($imgs as $img)
                      <div class="swiper-slide">
                          <img src="{{ asset('/') }}storage/{{ $img->img }}" alt="{{ $img->description }}" >
                      </div>
                  @endforeach
              </div>
           </div>
          </div>
            <div class="col-xl-7 ps-4 ps-lg-5 pe-4 pe-lg-1 d-flex align-items-stretch" data-aos="fade-left" data-aos-delay="100">
                <div class="content d-flex flex-column justify-content-center">
                    <h3>{{$achievement->name}}</h3>
                    <p>
                        {!! $achievement->description !!}
                    </p>
                    <div class="row p-3">
                        <div class="col-12 d-md-flex align-items-md-stretch">
                            <div class="count-box ">
                                <div class="col">
                                    <p>Peserta</p>
                                </div>
                                {{-- <input type="text" wire:model.live="search" class="form-control" placeholder="Cari nama..."> --}}
                                <table class="table col-12 table-striped">
                                    <thead>
                                      <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Nama</th>
                                        <th scope="col">Kelas</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                    <?php $no=1; ?> 
                                    @foreach ($students as $student)
                                    <tr>
                                      <th scope="row">{{$no++}}</th>
                                      <td>{{$student->student->nama}}</td>
                                      <td>{{$student->student->nama_rombel}}</td>
                                    </tr>
                                    @endforeach 
                                      
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        @include('vendor.pagination.bootstrap-5', ['paginator' => $students])
                    </div>
                </div><!-- End .content-->
            </div>
        </div>

    </div>
</main><!-- End #main --> 
@endsection
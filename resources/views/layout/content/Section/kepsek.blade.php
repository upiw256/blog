<section id="kepsek" class="counts">
            <div class="container" data-aos="fade-up">
                <div class="section-title">
                    <h2>profile</h2>
                    <p>Kepala Sekolah</p>
                </div>
                <div class="row no-gutters">
                    <div class="image col-xl-5 d-flex align-items-stretch justify-content-center justify-content-lg-start" data-aos="fade-right" data-aos-delay="100">
                    </div>
                    <div class="col-xl-7 ps-4 ps-lg-5 pe-4 pe-lg-1 d-flex align-items-stretch" data-aos="fade-left" data-aos-delay="100">
                        <div class="content d-flex flex-column justify-content-center">
                            <h3>Profile Kepala Sekolah</h3>
                            @if($kepsek->teacher)
    <p><b>Nama: </b>{{$kepsek->front_title}}{{$kepsek->teacher->nama}}, {{$kepsek->back_title}}</p>
    <p><b>NIP: </b>{{$kepsek->teacher->nip}}</P>
    <p><b>Tempat Tanggal Lahir: </b>{{$kepsek->teacher->tempat_lahir}}, {{strftime('%e %B %Y', strtotime($kepsek->teacher->tanggal_lahir))}}</P>
@endif
                            <div class="row">
                                <div class="col-md-12 d-md-flex align-items-md-stretch">
                                    <div class="count-box">
                                        <h1>Prestasi: </h1>
                                        {!! $kepsek->performance !!}
                                    </div>
                                </div>

                                
                        </div><!-- End .content-->
                    </div>
                </div>

            </div>
        </section>
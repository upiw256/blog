<section id="team" class="team">
    <div class="container" data-aos="fade-up">

        <div class="section-title">
            <h2>Team</h2>
            <p>Management Team</p>
        </div>

        <div class="row">
        @foreach ($staf as $s)
            
        <div class="col-lg-3 col-md-6 d-flex align-items-stretch">
                <div class="member" data-aos="fade-up" data-aos-delay="100">
                    <div class="member-img">
                        <img src="{{ asset('/') }}storage/{{$s->img}}" class="img-fluid" alt="">
                    </div>
                    <div class="member-info">
                        <h4>{{$s->teacher->nama}}</h4>
                        <span>NIP. {{$s->teacher->nip}}</span>
                        <span>{{$s->jabatan}}</span>
                    </div>
                </div>
        </div>
        @endforeach
        </div>

    </div>
</section>
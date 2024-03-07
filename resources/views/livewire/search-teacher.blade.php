<div>
    <div>
        <div class="section-title">
            <h2>Data</h2>
            <p>Guru dan Staf Administrasi SMAN 1 Margaasih</p>
        </div>
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
              <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Teachers</button>
            </li>
            <li class="nav-item" role="presentation">
              <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Staf Administrasi</button>
            </li>
          </ul>
          <div class="tab-content mt-3" id="myTabContent">
            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                <input type="text" wire:model.live="search" class="form-control" placeholder="Cari nama...">
                <div class="table-responsive mt-3">
                    <table class="table table-striped table-hover table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Bidang Studi Terakhir</th>
                                <th scope="col">Tempat Lahir</th>
                                <th scope="col">Tanggal Lahir</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($teachers as $teacher)
                            <tr>
                                <td>{{ $teacher->id }}</td>
                                <td>{{ $teacher->nama }}</td>
                                <td>{{ $teacher->bidang_studi_terakhir }}</td>
                                <td>{{ $teacher->tempat_lahir }}</td>
                                <td>{{ $teacher->tanggal_lahir }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-center">
                    @include('vendor.pagination.bootstrap-5', ['paginator' => $teachers])
                </div>
            </div>
            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                <div class="table-responsive mt-3">
                    <table class="table table-striped table-hover table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">nama</th>
                                <th scope="col">tempat lahir</th>
                                <th scope="col">tanggal lahir</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $no = 1;
                            @endphp
                        
                            @foreach ($tu as $teacher)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $teacher->nama }}</td>
                                <td>{{ $teacher->tempat_lahir }}</td>
                                <td>{{ $teacher->tanggal_lahir }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
          </div>
    </div>
</div>
    

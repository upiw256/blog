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
            <input type="text" wire:model.live="search" class="form-control" placeholder="Cari nama...">
            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                <div class="table-responsive mt-3">
                    <table class="table table-striped table-hover table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Bidang Studi Terakhir</th>
                                <th scope="col">Tempat Lahir</th>
                                <th scope="col">Tanggal Lahir</th>
                                <th scope="col">Jadwal</th>
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
                                <td>
                                    <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#scheduleModal{{ $teacher->id }}">
                                        Lihat Jadwal
                                    </button>
                                    <!-- Modal untuk Jadwal -->
                                    <div class="modal fade" id="scheduleModal{{ $teacher->id }}" tabindex="-1" aria-labelledby="scheduleModalLabel{{ $teacher->id }}" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-scrollable modal-fullscreen">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="scheduleModalLabel{{ $teacher->id }}">Jadwal {{ $teacher->nama }}</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        @foreach(['monday', 'tuesday', 'wednesday', 'thursday', 'friday'] as $index => $day)
                                                            <div class="col-md-3 mb-3">
                                                                <div class="card" style="height: 220px;"> <!-- Menyesuaikan tinggi card -->
                                                                    <div class="card-header text-center">
                                                                        <strong>{{ ucfirst($day) }}</strong>
                                                                    </div>
                                                                    <div class="card-body" style="height: calc(100% - 40px); padding: 5px;">
                                                                        @php
                                                                            $daySchedules = $teacher->schedules->filter(fn($schedule) => $schedule->day_of_week === $day);
                                                                        @endphp
                                                                        @if($daySchedules->isNotEmpty())
                                                                            <ul class="list-group" style="padding: 0;">
                                                                                @foreach($daySchedules as $schedule)
                                                                                    <li class="list-group-item" style="font-size: 12px; padding: 5px;">
                                                                                        <strong>{{ $schedule->classRoom->nama }}</strong> - {{ $schedule->teacherSubject->subject->name }} <br>
                                                                                        {{ \Carbon\Carbon::createFromFormat('H:i:s', $schedule->start_time)->format('H:i') }} - {{ \Carbon\Carbon::createFromFormat('H:i:s', $schedule->end_time)->format('H:i') }}
                                                                                    </li>
                                                                                @endforeach
                                                                            </ul>
                                                                        @else
                                                                            <p>Tidak ada jadwal untuk hari ini.</p>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    

                                </td>
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
                                <th scope="col">Nama</th>
                                <th scope="col">Tempat Lahir</th>
                                <th scope="col">Tanggal Lahir</th>
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

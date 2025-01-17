<div class="p-3"> <!-- Ini adalah elemen root -->
    <!-- Form untuk memilih kelas -->
    <div class="container">
        <form wire:submit.prevent="loadSchedule">
            <div class="form-group">
                <select id="classSelect" wire:model="selectedClassId" class="form-control">
                    <option value="">Pilih Kelas</option>
                    @foreach ($classRooms as $classRoom)
                        <option value="{{ $classRoom->id }}">{{ $classRoom->nama }}</option>
                    @endforeach
                </select>
            </div>
    
            <button type="submit" class="btn btn-primary mt-3 mb-3">Tampilkan Jadwal</button>
        </form>
    </div>

    <div class="row p-3">
        @php
            $daysOfWeek = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday'];
        @endphp
        
        @foreach ($daysOfWeek as $day)
            @php
                $daySchedules = collect($schedules)->where('day_of_week', $day);
            @endphp
    
            <div class="col-md-4 mb-2">
                <div class="card" style="max-width: 20rem; height: auto;">
                    <div class="card-header p-1">
                        <h6 class="card-title text-center fs-7">{{ ucfirst($day) }}</h6>
                    </div>
                    <div class="card-body p-1">
                        @if ($daySchedules->isNotEmpty())
                            @foreach ($daySchedules->sortBy('start_time') as $schedule)
                                <p class="fs-6 mb-1">
                                    <strong>{{ $schedule->teacherSubject->subject->name }}</strong> 
                                    <em>({{ $schedule->teacherSubject->teacher->nama }})</em>
                                </p>
                                <p class="fs-6 mb-0">
                                    <strong>{{ \Carbon\Carbon::parse($schedule->start_time)->format('H:i') }} - {{ \Carbon\Carbon::parse($schedule->end_time)->format('H:i') }}</strong>
                                </p>
                                <hr class="my-1">
                            @endforeach
                        @else
                            <p class="fs-6 mb-0 text-center text-muted">Jadwal Kosong</p>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    
    
    
</div>

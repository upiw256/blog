<div> <!-- Ini adalah elemen root -->
    <!-- Form untuk memilih kelas -->
    <div class="container mt-4">
        <form wire:submit.prevent="loadSchedule">
            <div class="form-group">
                <label for="classSelect">Pilih Kelas</label>
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

    <!-- Tampilkan jadwal jika sudah dipilih -->
    <div class="row p-3 "> <!-- Container untuk card -->
        @if ($schedules && $schedules->isNotEmpty())
            @foreach ($schedules as $schedule)
                <div class="col-md-4 mb-2"> <!-- Setiap card berada dalam kolom -->
                    <!-- Card untuk setiap jadwal dengan tinggi yang lebih pendek -->
                    <div class="card" style="max-width: 20rem; height: 12rem;"> <!-- Menetapkan lebar dan tinggi card -->
                        <div class="card-header p-1">
                            <h6 class="card-title text-center fs-7">{{ ucfirst($schedule->day_of_week) }}</h6> <!-- Mengurangi ukuran font dan tengah -->
                        </div>
                        <div class="card-body p-1" style="height: 8rem;"> <!-- Membatasi tinggi card-body -->
                            <p class="fs-6 mb-1"><strong>{{ $schedule->teacherSubject->subject->name }}</strong> <em>({{ $schedule->teacherSubject->teacher->nama }})</em></p>
                            <p class="fs-6 mb-0"><strong>{{ \Carbon\Carbon::parse($schedule->start_time)->format('H:i') }} - {{ \Carbon\Carbon::parse($schedule->end_time)->format('H:i') }}</strong>
                            </p>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <div class="col-12">
                <p>Jadwal tidak ditemukan.</p>
            </div>
        @endif
    </div>
    
    
</div>

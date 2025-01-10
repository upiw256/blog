<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Schedule;
use App\Models\ClassRoom;
use Illuminate\Support\Facades\Log;

class ScheduleByClass extends Component
{
    public $classId;
    public $selectedClassId;
    public $schedules = [];

    public function mount($classId = null)
    {
        $this->classId = $classId;
    }

    public function loadSchedule()
    {
        if ($this->selectedClassId) {
            // Ambil data jadwal berdasarkan class_room_id
            $this->schedules = Schedule::where('class_room_id', $this->selectedClassId)
                ->with(['teacherSubject.teacher', 'teacherSubject.subject'])
                ->orderBy('day_of_week')
                ->orderBy('start_time')
                ->get();
            // Log untuk debugging jika data ditemukan
            // Log::debug('Schedules loaded:', $this->schedules->toArray());
        } else {
            $this->schedules = [];
        }
    }

    public function render()
    {
        return view('livewire.schedule-by-class', [
            'classRooms' => ClassRoom::where('jenis_rombel_str', 'Kelas')->get(),
        ]);
    }
}

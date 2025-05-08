<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    /**
     * Ambil semua jadwal dengan relasi yang diperlukan.
     */
    public function index()
    {
        $schedules = Schedule::with(['teacherSubject.teacher', 'teacherSubject.subject', 'classRoom'])
            ->orderBy('day_of_week')
            ->orderBy('start_time')
            ->get();

        return $this->formatResponse($schedules);
    }

    /**
     * Ambil jadwal berdasarkan class_room_id.
     */
    public function show($id)
    {
        $schedules = Schedule::with(['teacherSubject.teacher', 'teacherSubject.subject', 'classRoom'])
            ->where('class_room_id', $id)
            ->orderBy('day_of_week')
            ->orderBy('start_time')
            ->get();

        return $this->formatResponse($schedules, 'Schedule not found');
    }

    /**
     * Ambil jadwal berdasarkan ptk_id guru.
     */
    public function teacher($id)
    {
        $schedules = Schedule::with(['teacherSubject.teacher', 'teacherSubject.subject', 'classRoom'])
            ->whereHas('teacherSubject.teacher', function ($query) use ($id) {
                $query->where('teacher_id', $id);
            })
            ->orderBy('day_of_week')
            ->orderBy('start_time')
            ->get();

        return $this->formatResponse($schedules, 'Schedule not found for this teacher');
    }

    /**
     * Format respons JSON.
     */
    private function formatResponse($schedules, $notFoundMessage = 'No schedules found')
    {
        if ($schedules->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => $notFoundMessage,
            ], 404);
        }

        $formattedSchedules = $schedules->map(function ($schedule) {
            return [
                'ptk_id' => optional($schedule->teacherSubject->teacher)->ptk_id,
                'day_of_week' => $schedule->day_of_week,
                'class_name' => optional($schedule->classRoom)->nama,
                'teacher_name' => optional($schedule->teacherSubject->teacher)->nama,
                'subject_name' => optional($schedule->teacherSubject->subject)->name,
                'start_time' => $schedule->start_time,
                'end_time' => $schedule->end_time,
            ];
        });

        return response()->json([
            'success' => true,
            'data' => $formattedSchedules,
        ]);
    }
}

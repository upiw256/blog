<?php

namespace App\Http\Controllers;
use App\Models\Schedule;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function index()
    {
        // Ambil semua data jadwal dengan relasi yang diperlukan
        $schedules = Schedule::with(['teacherSubject.teacher', 'teacherSubject.subject', 'classRoom'])
            ->orderBy('day_of_week')
            ->orderBy('start_time')
            ->get();

        // Format respons JSON
        return response()->json([
            'success' => true,
            'data' => $schedules,
        ]);
    }

    public function show($id)
    {
        // Ambil data jadwal berdasarkan ID dengan relasi
        $schedule = Schedule::with(['teacherSubject.teacher', 'teacherSubject.subject', 'classRoom'])->find($id);

        if (!$schedule) {
            return response()->json([
                'success' => false,
                'message' => 'Schedule not found',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $schedule,
        ]);
    }
}

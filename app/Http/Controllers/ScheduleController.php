<?php

namespace App\Http\Controllers;
use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

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
        // Ambil data jadwal berdasarkan class_room_id dengan relasi
        $schedules = Schedule::with(['teacherSubject.teacher', 'teacherSubject.subject', 'classRoom'])
        ->where('class_room_id', $id)
        ->orderBy('day_of_week')
        ->orderBy('start_time')
        ->get();

    // Format respons JSON
    $filteredSchedules = $schedules->map(function ($schedule) {
        return [
            'day_of_week' => $schedule->day_of_week,
            'class_name' => $schedule->classRoom->nama,
            'teacher_name' => $schedule->teacherSubject->teacher->nama,
            'subject_name' => $schedule->teacherSubject->subject->name,
            'start_time' => $schedule->start_time,
            'end_time' => $schedule->end_time,
        ];
    });
        if ($filteredSchedules->count() == 0) {
            return response()->json([
                'success' => false,
                'message' => 'Schedule not found',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $filteredSchedules,
        ]);
    }
    public function teacher($id)
    {
         // Ambil data jadwal berdasarkan class_room_id dengan relasi
         $schedules = Schedule::select('schedules.*')
         ->join('teacher_subjects', 'schedules.teacher_subject_id', '=', 'teacher_subjects.id')
         ->join('teachers', 'teacher_subjects.teacher_id', '=', 'teachers.id')
         ->join('class_rooms', 'schedules.class_room_id', '=', 'class_rooms.id')
         ->where('teachers.id', $id)
         ->orderBy('schedules.day_of_week')
         ->orderBy('schedules.start_time')
         ->get();
 
     // Format respons JSON
     $filteredSchedules = $schedules->map(function ($schedule) {
         return [
             'teacher_id' => $schedule->teacherSubject->teacher->id,
             'day_of_week' => $schedule->day_of_week,
             'class_name' => $schedule->classRoom->nama,
             'teacher_name' => $schedule->teacherSubject->teacher->nama,
             'subject_name' => $schedule->teacherSubject->subject->name,
             'start_time' => $schedule->start_time,
             'end_time' => $schedule->end_time,
         ];
     });
         if ($filteredSchedules->count() == 0) {
             return response()->json([
                 'success' => false,
                 'message' => 'Schedule not found',
             ], 404);
         }
 
         return response()->json([
             'success' => true,
             'data' => $filteredSchedules,
         ]);
    }
}

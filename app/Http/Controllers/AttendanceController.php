<?php
namespace App\Http\Controllers;

use App\Models\Attendance;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AttendanceController extends Controller
{
    public function store(Request $request)
    {
        if ($request->isMethod('post') && empty($request->all())) {
            return response()->json([
                'error' => 'Request body cannot be empty',
            ], Response::HTTP_BAD_REQUEST);
        }

        $validatedData = $request->validate([
            'student_id' => 'required|exists:students,id',
            'date' => 'required|date',
            'present' => 'required|boolean',
        ]);

        $attendance = Attendance::create($validatedData);

        return response()->json([
            'message' => 'Attendance recorded successfully',
            'data' => $attendance,
        ], Response::HTTP_CREATED);
    }
}

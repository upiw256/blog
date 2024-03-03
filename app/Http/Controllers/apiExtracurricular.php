<?php

namespace App\Http\Controllers;

use App\Models\ExtracurricularActivity;
use App\Models\member_extra;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Env;

class apiExtracurricular extends Controller
{
    function index()
    {
        $memberExtras = ExtracurricularActivity::all();
        $response = [];
        foreach ($memberExtras as $memberExtra) {
           
            $response[] = [
                'id' => $memberExtra->id,
                'name' => $memberExtra->name,
                'image' => Env::get('APP_URL') . '/' .'storage/' . $memberExtra->logo,
                'description' => $memberExtra->description,                  
                
            ];
        }
        return response()->json($response);
    }
    function show(Request $request) {
        $Extras = ExtracurricularActivity::find($request->id);   
        if (!$Extras) {
            return response()->json([
                'message' => 'Extras not found'
            ], 404);
        }
        $memberExtra = new member_extra();
        $member = $memberExtra->count_member($request->id);
        $student = $memberExtra->with('student')->where('extracurricular_activity_id', $request->id)->get();
        $students = [];
        foreach ($student as $data) {
            $students[] = [
                'id' => $data->student->id,
                'name' => $data->student->nama,
                'kelas'=> $data->student->nama_rombel,
                'jenis_kelamin' => $data->student->jenis_kelamin
                
            ];
        }
        $response = [
            'id' => $Extras->id,
            'name' => $Extras->name,
            'image' => Env::get('APP_URL') . '/' .'storage/' . $Extras->logo,
            'description' => $Extras->description,
            'member_count' => $member,
            'student' => $students
        ];
        return response()->json($response);
           
    }
}

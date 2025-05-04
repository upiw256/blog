<?php

namespace App\Http\Controllers;

use App\Models\headmaster;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\SubjectGrade;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Routing\Controller;
class CertificateController extends Controller
{
    public function download($id)
    {
        $student = Student::with('graduation.subjectGrades')->findOrFail($id);
        $subjectGrades = $student->graduation ? $student->graduation->subjectGrades : collect();
        $headmaster = headmaster::with('teacher')->first(); // Fetch the headmaster and their teacher data
        $pdf = Pdf::loadView('certificate', compact('student', 'subjectGrades', 'headmaster'))->setPaper('a4', 'portrait');
        return $pdf->download('Surat_Kelulusan_' . $student->nama . '.pdf');
    }
}
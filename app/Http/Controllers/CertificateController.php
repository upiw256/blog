<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Routing\Controller;

class CertificateController extends Controller
{
    public function download($id)
    {
        $student = Student::findOrFail($id);
        $pdf = Pdf::loadView('certificate', compact('student'))->setPaper('a4', 'portrait');
        return $pdf->download('Surat_Kelulusan_' . $student->nama . '.pdf');
    }
}
<?php

namespace App\Exports;

use App\Models\Graduation;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class GraduationsExport implements FromCollection, WithHeadings
{
    /**
     * Return the collection of data to be exported.
     */
    public function collection()
    {
        return Graduation::with('student')->get()->map(function ($graduation) {
            return [
                'Student Name' => $graduation->student->nama,
                'Class Name' => $graduation->student->nama_rombel,
                'Graduation Status' => $graduation->information ? 'Passed' : 'Not Passed',
            ];
        });
    }

    /**
     * Return the headings for the Excel file.
     */
    public function headings(): array
    {
        return [
            'Student Name',
            'Class Name',
            'Graduation Status',
        ];
    }
}

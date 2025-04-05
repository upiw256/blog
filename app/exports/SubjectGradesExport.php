<?php

namespace App\Exports;

use App\Models\SubjectGrade;
use App\Models\Subject;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class SubjectGradesExport implements FromCollection, WithHeadings, WithStyles
{
    protected $student;
    protected $subjectFilter;

    public function __construct($student, $subjectFilter = null)
    {
        $this->student = $student;
        $this->subjectFilter = $subjectFilter; // Optional subject filter
    }

    /**
     * Return the collection of data to be exported.
     */
    public function collection()
    {
        $query = SubjectGrade::with('subject', 'graduation.student')
            ->whereHas('graduation', function ($query) {
                $query->where('student_id', $this->student->id);
            });

        // Apply subject filter if provided
        if ($this->subjectFilter) {
            $query->whereHas('subject', function ($query) {
                $query->where('name', $this->subjectFilter);
            });
        }

        $grades = $query->get();

        // Check if there are existing subject grades
        if ($grades->isEmpty()) {
            return collect([
                ['No data available for the selected student or subject.']
            ]);
        }

        return $grades->map(function ($grade, $index) {
            return [
                'No' => $index + 1,
                'Subject Name' => $grade->subject->name,
                'Grade' => $grade->value,
            ];
        });
    }

    /**
     * Return the headings for the Excel file.
     */
    public function headings(): array
    {
        return [
            'No',
            'Subject Name',
            'Grade',
        ];
    }

    /**
     * Apply styles to the worksheet.
     */
    public function styles(Worksheet $sheet)
    {
        // Add student details in cell A1
        $sheet->setCellValue('A1', 'Student Name: ' . $this->student->nama);
        $sheet->setCellValue('A2', 'Class: ' . $this->student->nama_rombel);
        $sheet->setCellValue('A3', 'Graduation ID: ' . $this->student->graduation->id);

        // Fetch all subject names and display them vertically starting from F1
        $subjectNames = Subject::pluck('name');
        $startRow = 1; // Start from row 1 in column F
        foreach ($subjectNames as $index => $subjectName) {
            $sheet->setCellValue('F' . ($startRow + $index), $subjectName);
        }

        // Merge cells for student details
        $sheet->mergeCells('A1:C1');
        $sheet->mergeCells('A2:C2');
        $sheet->mergeCells('A3:C3'); // Merge cells for Graduation ID

        // Apply bold style to student details
        $sheet->getStyle('A1:A3')->getFont()->setBold(true);

        // Add column headers in row 5
        $sheet->setCellValue('A5', 'No');
        $sheet->setCellValue('B5', 'Subject Name');
        $sheet->setCellValue('C5', 'Grade');

        // Apply bold style to column headers
        $sheet->getStyle('A5:C5')->getFont()->setBold(true);
        $sheet->getStyle('A5:C5')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        // Apply borders to the table
        $lastRow = $sheet->getHighestRow();
        $sheet->getStyle('A5:C' . $lastRow)->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
            ],
        ]);
        $sheet->getStyle('F1:F' . $lastRow)->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
            ],
        ]);

        return $sheet;
    }
}

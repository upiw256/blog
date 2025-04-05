<?php

namespace App\Imports;

use App\Models\SubjectGrade;
use App\Models\Subject;
use App\Models\Graduation;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class SubjectGradesImport implements ToCollection
{
    protected $studentId;

    public function __construct($studentId)
    {
        $this->studentId = $studentId;
    }

    public function collection(Collection $rows)
    {
        // Retrieve the graduation record for the student
        $graduation = Graduation::where('student_id', $this->studentId)->first();

        if (!$graduation) {
            throw new \Exception("Graduation record not found for student ID: {$this->studentId}");
        }

        foreach ($rows as $index => $row) {
            if ($index === 0) {
                // Skip the header row
                continue;
            }

            $subject = Subject::where('name', $row[1])->first();

            if ($subject) {
                SubjectGrade::updateOrCreate(
                    [
                        'id_graduation' => $graduation->id, // Use the graduation ID
                        'kode_subject' => $subject->id,
                    ],
                    [
                        'value' => $row[2],
                    ]
                );
            }
        }
    }
}

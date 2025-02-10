<?php

namespace App\Exports;

use App\Models\ClassRoom;
use App\Models\TeacherSubject;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;

class ScheduleTemplateExport implements WithMultipleSheets
{
    public function sheets(): array
    {
        return [
            new ScheduleTemplateSheet(),
            new ClassRoomSheet(),
            new TeacherSubjectSheet(),
        ];
    }
}

class ScheduleTemplateSheet implements FromCollection, WithHeadings
{
    public function collection()
    {
        return collect([
            ['class_room_id', 'teacher_subject_id', 'day_of_week', 'start_time', 'end_time']
        ]);
    }

    public function headings(): array
    {
        return [
            'Class Room ID',
            'Teacher Subject ID',
            'Day of Week (monday, tuesday, etc.)',
            'Start Time (HH:mm)',
            'End Time (HH:mm)'
        ];
    }
}

class ClassRoomSheet implements FromCollection, WithHeadings
{
    public function collection()
    {
        return ClassRoom::select('id', 'nama')->get();
    }

    public function headings(): array
    {
        return ['ID', 'Classroom Name'];
    }
}

class TeacherSubjectSheet implements FromCollection, WithHeadings
{
    public function collection()
    {
        return TeacherSubject::with(['teacher', 'subject'])->get()->map(function ($teacherSubject) {
            return [
                'id' => $teacherSubject->id,
                'teacher' => $teacherSubject->teacher->nama ?? 'No Teacher',
                'subject' => $teacherSubject->subject->name ?? 'No Subject',
            ];
        });
    }

    public function headings(): array
    {
        return ['ID', 'Teacher Name', 'Subject Name'];
    }
}

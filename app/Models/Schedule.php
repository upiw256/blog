<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Schedule extends Model
{
    use HasFactory;
    protected $fillable = [
        'class_room_id',
        'teacher_subject_id',
        'day_of_week',
        'start_time',
        'end_time'
    ];
    public function classRoom(): BelongsTo
    {
        return $this->belongsTo(ClassRoom::class, 'class_room_id');
    }
    public function teacherSubject(): BelongsTo
    {
        return $this->belongsTo(TeacherSubject::class, 'teacher_subject_id');
    }
    public function subject(): BelongsTo
    {
        return $this->belongsTo(Subject::class);
    }
    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    // public function subject()
    // {
    //     return $this->teacherSubject->subject();  // Mengakses mata pelajaran melalui relasi TeacherSubject
    // }
}

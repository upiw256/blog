<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Schedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'teacher_subject_id',
        'day_of_week',
        'start_time',
        'end_time',
        'class_room_id',
    ];

    /**
     * Define the relationship with TeacherSubject.
     */
    public function teacherSubject(): BelongsTo
    {
        return $this->belongsTo(TeacherSubject::class, 'teacher_subject_id', 'id');
    }

    /**
     * Define the relationship with ClassRoom.
     */
    public function classRoom(): BelongsTo
    {
        return $this->belongsTo(ClassRoom::class, 'class_room_id', 'id');
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

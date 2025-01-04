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
        return $this->belongsTo(ClassRoom::class);
    }
    public function teacherSubject(): BelongsTo
    {
        return $this->belongsTo(TeacherSubject::class);
    }
}

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
        'class_room_id',
        'day_of_week',
        'start_time',
        'end_time',
    ];

    /**
     * Relasi ke TeacherSubject.
     */
    public function teacherSubject(): BelongsTo
    {
        return $this->belongsTo(TeacherSubject::class, 'teacher_subject_id');
    }

    /**
     * Relasi ke ClassRoom.
     */
    public function classRoom(): BelongsTo
    {
        return $this->belongsTo(ClassRoom::class, 'class_room_id');
    }

    /**
     * Scope untuk filter berdasarkan hari.
     */
    public function scopeByDay($query, $day)
    {
        return $query->where('day_of_week', $day);
    }

    /**
     * Scope untuk filter berdasarkan waktu mulai.
     */
    public function scopeByStartTime($query, $startTime)
    {
        return $query->where('start_time', '>=', $startTime);
    }

    /**
     * Scope untuk filter berdasarkan waktu selesai.
     */
    public function scopeByEndTime($query, $endTime)
    {
        return $query->where('end_time', '<=', $endTime);
    }
}

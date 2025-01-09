<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Validation\ValidationException;

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
    public static function boot()
    {
        parent::boot();

        static::creating(function ($schedule) {
            // Validasi bentrok jadwal sebelum data disimpan
            if ($schedule->isScheduleConflict($schedule->day_of_week, $schedule->start_time)) {
                throw ValidationException::withMessages([
                    'start_time' => 'Jadwal dengan waktu dan hari yang sama sudah ada.',
                ]);
            }
        });

        static::updating(function ($schedule) {
            // Validasi bentrok jadwal sebelum data diperbarui
            if ($schedule->isScheduleConflict($schedule->day_of_week, $schedule->start_time)) {
                throw ValidationException::withMessages([
                    'start_time' => 'Jadwal dengan waktu dan hari yang sama sudah ada.',
                ]);
            }
        });
    }

    public function isScheduleConflict($day, $startTime)
    {
        return self::where('day_of_week', $day)
            ->where('start_time', $startTime)
            ->exists();
    }
}

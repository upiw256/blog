<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Graduation extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $table = 'graduations';

    /**
     * Get the student associated with the graduation.
     */
    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class, 'student_id');
    }

    /**
     * Get the subject grades associated with the graduation.
     */
    public function subject_grades(): HasMany
    {
        return $this->hasMany(SubjectGrade::class, 'id_graduation');
    }
}

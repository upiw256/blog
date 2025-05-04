<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SubjectGrade extends Model
{
    use HasFactory;

    protected $table = 'subject_grades';

    protected $fillable = [
        'id_graduation',
        'kode_subject',
        'value',
    ];

    /**
     * Get the graduation associated with the subject grade.
     */
    public function graduation(): BelongsTo
    {
        return $this->belongsTo(Graduation::class, 'id_graduation');
    }

    /**
     * Get the student associated with the subject grade through graduation.
     */
    public function student(): ?BelongsTo
    {
        if ($this->graduation) {
            return $this->graduation->student();
        }

        return null; // Return null if graduation is not set
    }

    /**
     * Get the subject associated with the subject grade.
     */
    public function subject(): BelongsTo
    {
        return $this->belongsTo(Subject::class, 'kode_subject', 'id');
    }
}

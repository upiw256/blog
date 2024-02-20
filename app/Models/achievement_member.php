<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class achievement_member extends Model
{
    use HasFactory;
    protected $fillable = [
        'achievement_id',
        'student_id'
    ];
    public function achievement(): BelongsTo
    {
        return $this->belongsTo(Achievement::class);
    }

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }

}

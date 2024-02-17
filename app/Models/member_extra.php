<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class member_extra extends Model
{
    // protected $casts = [
    //     'student_id' => 'array',
    // ];
    use HasFactory;
    protected $fillable = ['student_id', 'extracurricular_id'];

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }

    public function ExtracurricularActivity(): BelongsTo
    {
        return $this->belongsTo(ExtracurricularActivity::class);
    }

    public function count_member($id)
    {
        return $this->where('extracurricular_activity_id', $id)
            ->count();
    }
}

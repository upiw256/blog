<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class schedule extends Model
{
    use HasFactory;
    protected $fillable = [
        'day',
        'start_time',
        'end_time',
    ];

    public function classRoom() : BelongsTo
    {
        return $this->BelongsTo(ClassRoom::class);
    }
    function teacher() : BelongsTo {
        return $this->BelongsTo(Teacher::class);
    }

    function subject() : BelongsTo
    {
        return $this->BelongsTo(Subject::class);
    }

}

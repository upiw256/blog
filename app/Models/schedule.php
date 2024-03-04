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

    public function classRoom() : HasMany
    {
        return $this->HasMany(ClassRoom::class);
    }
    function teacher() : HasMany {
        return $this->HasMany(Teacher::class);
    }

    function subject() : HasMany
    {
        return $this->HasMany(Subject::class);
    }

}

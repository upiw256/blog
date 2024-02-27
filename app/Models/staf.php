<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class staf extends Model
{
    use HasFactory;
    protected $fillable = [
        'teacher_id',
        'jabatan',
        'img',
    ];

    public function Teacher(): BelongsTo
    {
        return $this->BelongsTo(Teacher::class);
    }
}

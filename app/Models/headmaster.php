<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class headmaster extends Model
{
    use HasFactory;
    protected $fillable = [
        "teacher_id",
        "performance",
        "image",
        "font_title",
        "back_title"
    ];
    public function teacher(): BelongsTo{
        return $this->belongsTo(Teacher::class);
    }
}

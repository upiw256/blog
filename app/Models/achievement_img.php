<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class achievement_img extends Model
{
    use HasFactory;
    protected $fillable = [
        'achievement_id',
        'img',
        'description',
    ];
    public function achievement(): BelongsTo
    {
        return $this->belongsTo(Achievement::class);
    }
}

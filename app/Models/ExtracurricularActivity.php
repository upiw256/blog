<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ExtracurricularActivity extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function member_extra(): HasMany
    {
        return $this->hasMany(member_extra::class);
    }
}

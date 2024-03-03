<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class subject extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'max_hours'];

    function schedule() : BelongsTo {
        return $this->belongsTo(Schedule::class);
    }
}

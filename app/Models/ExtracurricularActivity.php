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
    protected $fillable = ['nama'];

    public function student(): HasMany
    {
        return $this->HasMany(Student::class);
    }
}

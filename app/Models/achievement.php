<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class achievement extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'category', 'description', 'level', 'img', 'champion_to', 'year'];

    public function student(): HasMany
    {
        return $this->hasMany(achievement_member::class);
    }
    public function achievement_img(): HasMany
    {
        return $this->hasMany(achievement_img::class);
    }
}

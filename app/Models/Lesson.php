<?php

namespace App\Models;

use App\Enums\LessonDifficultyLevel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Lesson extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'instrument',
        'teacher_name',
        'difficulty_level',
        'duration_minutes',
        'description',
        'is_active',
    ];

    protected $casts = [
        'difficulty_level' => LessonDifficultyLevel::class
    ];

    public function lessonSlots(): HasMany
    {
        return $this->hasMany(LessonSlot::class);
    }
}

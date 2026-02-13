<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LessonDetailResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'instrument' => $this->instrument,
            'difficulty_level' => $this->difficulty_level,
            'duration_minutes' => $this->duration_minutes,
            'description' => $this->description,
            'teacher' => [
                'id' => $this->teacher->id,
                'name' => $this->teacher->name,
                'bio' => $this->teacher->bio,
            ],
            'slots' => $this->slots->map(fn($s) => [
                'id' => $s->id,
                'starts_at' => $s->starts_at?->toISOString(),
                'ends_at' => $s->ends_at?->toISOString(),
                'max_students' => $s->max_students,
            ])->values(),
        ];
    }
}

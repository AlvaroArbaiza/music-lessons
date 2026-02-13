<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LessonResource extends JsonResource
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
            'teacher_name' => $this->teacher_name,
        ];
    }
}

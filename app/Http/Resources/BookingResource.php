<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BookingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $slot = $this->lessonSlot;
        $lesson = $slot?->lesson;

        return [
            'id' => $this->id,
            'status' => $this->status,
            'note' => $this->note,
            'slot' => $slot ? [
                'id' => $slot->id,
                'starts_at' => $slot->starts_at?->toISOString(),
                'ends_at' => $slot->ends_at?->toISOString(),
            ] : [],
            'lesson' => $lesson ? [
                'id' => $lesson->id,
                'title' => $lesson->title,
            ] : [],
        ];
    }
}

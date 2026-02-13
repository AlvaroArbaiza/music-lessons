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
        return [
            'id' => $this->id,
            'status' => $this->status,
            'note' => $this->note,
            'slot' => [
                'id' => $this->slot->id,
                'starts_at' => $this->slot->starts_at?->toISOString(),
                'ends_at' => $this->slot->ends_at?->toISOString(),
            ],
            'lesson' => [
                'id' => $this->slot->lesson->id,
                'title' => $this->slot->lesson->title,
            ],
        ];
    }
}

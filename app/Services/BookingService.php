<?php 

namespace App\Services;

use App\Models\Booking;
use App\Models\LessonSlot;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class BookingService
{
    public function create(User $user, int $slotId, ?string $note = null): Booking
    {
        return DB::transaction(function () use ($user, $slotId, $note) {

            /** @var LessonSlot $slot */
            $slot = LessonSlot::query()
                ->with('lesson')
                ->lockForUpdate()
                ->findOrFail($slotId);

            if ($slot->is_cancelled) {
                throw ValidationException::withMessages([
                    'lesson_slot_id' => 'Questo slot non è più disponibile.',
                ]);
            }

            $conflict = Booking::query()
                ->where('user_id', $user->id)
                ->where('status', 'confirmed')
                ->whereHas('slot', function ($q) use ($slot) {
                    $q->where('starts_at', '<', $slot->ends_at)
                      ->where('ends_at', '>', $slot->starts_at);
                })
                ->exists();

            if ($conflict) {
                throw ValidationException::withMessages([
                    'lesson_slot_id' => 'Hai già una prenotazione che si sovrappone a questo orario.',
                ]);
            }

            $capacity = (int) ($slot->max_students ?? 1);

            $booked = Booking::query()
                ->where('lesson_slot_id', $slot->id)
                ->where('status', 'confirmed')
                ->lockForUpdate()
                ->count();

            if ($booked >= $capacity) {
                throw ValidationException::withMessages([
                    'lesson_slot_id' => 'Posti esauriti per questo slot.',
                ]);
            }

            return Booking::create([
                'user_id' => $user->id,
                'lesson_slot_id' => $slot->id,
                'note' => $note,
                'status' => 'confirmed',
            ]);
        });
    }
}

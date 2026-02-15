<?php

namespace Tests\Feature;

use App\Models\Booking;
use App\Models\Lesson;
use App\Models\LessonSlot;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BookingControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_cannot_access_bookings(): void
    {
        $response = $this->get(route('bookings.index'));

        $response->assertRedirect(route('login'));
    }

    public function test_user_can_view_their_bookings(): void
    {
        $user = User::factory()->create();
        $lesson = Lesson::factory()->create();
        $slot = LessonSlot::factory()->create(['lesson_id' => $lesson->id]);

        Booking::factory()->count(3)->create([
            'user_id' => $user->id,
            'lesson_slot_id' => $slot->id,
        ]);

        // Altri utenti con loro prenotazioni
        Booking::factory()->count(2)->create();

        $response = $this->actingAs($user)->get(route('bookings.index'));

        $response->assertOk();
        $response->assertViewIs('bookings.index');
        $response->assertViewHas('bookings');

        // Verifica paginazione
        $bookings = $response->viewData('bookings');
        $this->assertCount(3, $bookings);
    }

    public function test_user_can_create_booking(): void
    {
        $user = User::factory()->create();
        $lesson = Lesson::factory()->create();
        $slot = LessonSlot::factory()->create([
            'lesson_id' => $lesson->id,
            'starts_at' => now()->addDay(),
            'ends_at' => now()->addDay()->addHour(),
            'max_students' => 5,
            'is_cancelled' => false,
        ]);

        $response = $this->actingAs($user)->post(route('bookings.store'), [
            'lesson_slot_id' => $slot->id,
            'note' => 'Test booking note',
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('status', 'Prenotazione creata!');

        $this->assertDatabaseHas('bookings', [
            'user_id' => $user->id,
            'lesson_slot_id' => $slot->id,
            'note' => 'Test booking note',
            'status' => 'confirmed',
        ]);
    }

    public function test_create_booking_requires_valid_slot(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post(route('bookings.store'), [
            'lesson_slot_id' => 99999,
            'note' => 'Test note',
        ]);

        $response->assertSessionHasErrors('lesson_slot_id');
    }

    public function test_create_booking_note_is_optional(): void
    {
        $user = User::factory()->create();
        $lesson = Lesson::factory()->create();
        $slot = LessonSlot::factory()->create([
            'lesson_id' => $lesson->id,
            'starts_at' => now()->addDay(),
            'ends_at' => now()->addDay()->addHour(),
            'max_students' => 5,
        ]);

        $response = $this->actingAs($user)->post(route('bookings.store'), [
            'lesson_slot_id' => $slot->id,
        ]);

        $response->assertRedirect();

        $this->assertDatabaseHas('bookings', [
            'user_id' => $user->id,
            'lesson_slot_id' => $slot->id,
            'note' => null,
        ]);
    }

    public function test_user_can_update_their_booking_note(): void
    {
        $user = User::factory()->create();
        $lesson = Lesson::factory()->create();
        $slot = LessonSlot::factory()->create(['lesson_id' => $lesson->id]);
        $booking = Booking::factory()->create([
            'user_id' => $user->id,
            'lesson_slot_id' => $slot->id,
            'note' => 'Original note',
        ]);

        $response = $this->actingAs($user)->patch(route('bookings.update', $booking), [
            'note' => 'Updated note',
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('status', 'Prenotazione aggiornata!');

        $this->assertDatabaseHas('bookings', [
            'id' => $booking->id,
            'note' => 'Updated note',
        ]);
    }

    public function test_user_cannot_update_other_users_booking(): void
    {
        $owner = User::factory()->create();
        $otherUser = User::factory()->create();
        $lesson = Lesson::factory()->create();
        $slot = LessonSlot::factory()->create(['lesson_id' => $lesson->id]);
        $booking = Booking::factory()->create([
            'user_id' => $owner->id,
            'lesson_slot_id' => $slot->id,
        ]);

        $response = $this->actingAs($otherUser)->patch(route('bookings.update', $booking), [
            'note' => 'Hacked note',
        ]);

        $response->assertForbidden();
    }

    public function test_user_can_cancel_their_booking(): void
    {
        $user = User::factory()->create();
        $lesson = Lesson::factory()->create();
        $slot = LessonSlot::factory()->create(['lesson_id' => $lesson->id]);
        $booking = Booking::factory()->create([
            'user_id' => $user->id,
            'lesson_slot_id' => $slot->id,
            'status' => 'confirmed',
        ]);

        $response = $this->actingAs($user)->delete(route('bookings.destroy', $booking));

        $response->assertRedirect();
        $response->assertSessionHas('status', 'Prenotazione annullata.');

        $this->assertDatabaseHas('bookings', [
            'id' => $booking->id,
            'status' => 'cancelled',
        ]);
    }

    public function test_user_cannot_cancel_other_users_booking(): void
    {
        $owner = User::factory()->create();
        $otherUser = User::factory()->create();
        $lesson = Lesson::factory()->create();
        $slot = LessonSlot::factory()->create(['lesson_id' => $lesson->id]);
        $booking = Booking::factory()->create([
            'user_id' => $owner->id,
            'lesson_slot_id' => $slot->id,
            'status' => 'confirmed',
        ]);

        $response = $this->actingAs($otherUser)->delete(route('bookings.destroy', $booking));

        $response->assertForbidden();

        $this->assertDatabaseHas('bookings', [
            'id' => $booking->id,
            'status' => 'confirmed',
        ]);
    }

}

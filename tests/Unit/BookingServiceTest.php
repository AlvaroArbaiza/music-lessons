<?php

namespace Tests\Unit;

use App\Models\Booking;
use App\Models\Lesson;
use App\Models\LessonSlot;
use App\Models\User;
use App\Services\BookingService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Validation\ValidationException;
use Tests\TestCase;

class BookingServiceTest extends TestCase
{
    use RefreshDatabase;

    private BookingService $service;

    protected function setUp(): void
    {
        parent::setUp();
        $this->service = new BookingService();
    }

    public function test_creates_booking_successfully(): void
    {
        $user = User::factory()->create();
        $lesson = Lesson::factory()->create(['is_active' => true]);
        $slot = LessonSlot::factory()->create([
            'lesson_id' => $lesson->id,
            'starts_at' => now()->addDay(),
            'ends_at' => now()->addDay()->addHour(),
            'max_students' => 5,
            'is_cancelled' => false,
        ]);

        $booking = $this->service->create($user, $slot->id, 'Test note');

        $this->assertInstanceOf(Booking::class, $booking);
        $this->assertEquals($user->id, $booking->user_id);
        $this->assertEquals($slot->id, $booking->lesson_slot_id);
        $this->assertEquals('Test note', $booking->note);
        $this->assertEquals('confirmed', $booking->status);
        $this->assertDatabaseHas('bookings', [
            'user_id' => $user->id,
            'lesson_slot_id' => $slot->id,
            'status' => 'confirmed',
        ]);
    }

    public function test_creates_booking_without_note(): void
    {
        $user = User::factory()->create();
        $lesson = Lesson::factory()->create();
        $slot = LessonSlot::factory()->create([
            'lesson_id' => $lesson->id,
            'starts_at' => now()->addDay(),
            'ends_at' => now()->addDay()->addHour(),
            'max_students' => 5,
        ]);

        $booking = $this->service->create($user, $slot->id);

        $this->assertNull($booking->note);
    }

    public function test_fails_when_slot_is_cancelled(): void
    {
        $user = User::factory()->create();
        $lesson = Lesson::factory()->create();
        $slot = LessonSlot::factory()->create([
            'lesson_id' => $lesson->id,
            'starts_at' => now()->addDay(),
            'ends_at' => now()->addDay()->addHour(),
            'is_cancelled' => true,
        ]);

        $this->expectException(ValidationException::class);
        $this->expectExceptionMessage('Questo slot non è più disponibile.');

        $this->service->create($user, $slot->id);
    }

    public function test_fails_when_user_has_time_conflict(): void
    {
        $user = User::factory()->create();
        $lesson1 = Lesson::factory()->create();
        $lesson2 = Lesson::factory()->create();

        // Prima prenotazione: 10:00 - 11:00
        $slot1 = LessonSlot::factory()->create([
            'lesson_id' => $lesson1->id,
            'starts_at' => now()->setTime(10, 0),
            'ends_at' => now()->setTime(11, 0),
        ]);

        Booking::factory()->create([
            'user_id' => $user->id,
            'lesson_slot_id' => $slot1->id,
            'status' => 'confirmed',
        ]);

        // Secondo slot che si sovrappone: 10:30 - 11:30
        $slot2 = LessonSlot::factory()->create([
            'lesson_id' => $lesson2->id,
            'starts_at' => now()->setTime(10, 30),
            'ends_at' => now()->setTime(11, 30),
        ]);

        $this->expectException(ValidationException::class);
        $this->expectExceptionMessage('Hai già una prenotazione che si sovrappone a questo orario.');

        $this->service->create($user, $slot2->id);
    }

    public function test_fails_when_slot_capacity_is_full(): void
    {
        $lesson = Lesson::factory()->create();
        $slot = LessonSlot::factory()->create([
            'lesson_id' => $lesson->id,
            'starts_at' => now()->addDay(),
            'ends_at' => now()->addDay()->addHour(),
            'max_students' => 2,
        ]);

        // Crea 2 prenotazioni (capacità piena)
        Booking::factory()->count(2)->create([
            'lesson_slot_id' => $slot->id,
            'status' => 'confirmed',
        ]);

        // Terzo utente cerca di prenotare
        $user = User::factory()->create();

        $this->expectException(ValidationException::class);
        $this->expectExceptionMessage('Posti esauriti per questo slot.');

        $this->service->create($user, $slot->id);
    }

    public function test_uses_database_transaction_on_error(): void
    {
        $user = User::factory()->create();
        $lesson = Lesson::factory()->create();
        $slot = LessonSlot::factory()->create([
            'lesson_id' => $lesson->id,
            'starts_at' => now()->addDay(),
            'ends_at' => now()->addDay()->addHour(),
            'is_cancelled' => true,
        ]);

        $initialCount = Booking::count();

        try {
            $this->service->create($user, $slot->id);
        } catch (ValidationException $e) {
            // Atteso
        }

        // Nessuna prenotazione deve essere stata creata
        $this->assertEquals($initialCount, Booking::count());
    }
}

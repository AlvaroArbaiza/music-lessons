<?php

namespace Tests\Feature;

use App\Models\Booking;
use App\Models\Lesson;
use App\Models\LessonSlot;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LessonControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_displays_only_active_lessons(): void
    {
        $user = User::factory()->create();
        Lesson::factory()->create(['is_active' => true, 'title' => 'Active Lesson']);
        Lesson::factory()->create(['is_active' => false, 'title' => 'Inactive Lesson']);

        $response = $this->actingAs($user)->get(route('lessons.index'));

        $response->assertOk();
        $response->assertViewIs('lessons.index');
        $response->assertSee('Active Lesson');
        $response->assertDontSee('Inactive Lesson');
    }

    public function test_index_only_includes_non_cancelled_future_slots(): void
    {
        $user = User::factory()->create();
        $lesson = Lesson::factory()->create(['is_active' => true]);

        // Slot futuro valido
        $futureSlot = LessonSlot::factory()->create([
            'lesson_id' => $lesson->id,
            'starts_at' => now()->addDay(),
            'ends_at' => now()->addDay()->addHour(),
            'is_cancelled' => false,
        ]);

        // Slot passato
        LessonSlot::factory()->create([
            'lesson_id' => $lesson->id,
            'starts_at' => now()->subDay(),
            'ends_at' => now()->subDay()->addHour(),
            'is_cancelled' => false,
        ]);

        // Slot cancellato
        LessonSlot::factory()->create([
            'lesson_id' => $lesson->id,
            'starts_at' => now()->addDays(2),
            'ends_at' => now()->addDays(2)->addHour(),
            'is_cancelled' => true,
        ]);

        $response = $this->actingAs($user)->get(route('lessons.index'));

        $lessons = $response->viewData('lessons');
        $slots = $lessons->first()->lessonSlots;

        $this->assertCount(1, $slots);
        $this->assertEquals($futureSlot->id, $slots->first()->id);
    }

    public function test_index_includes_confirmed_bookings_count(): void
    {
        $user = User::factory()->create();
        $lesson = Lesson::factory()->create(['is_active' => true]);
        $slot = LessonSlot::factory()->create([
            'lesson_id' => $lesson->id,
            'starts_at' => now()->addDay(),
            'ends_at' => now()->addDay()->addHour(),
            'max_students' => 5,
        ]);

        // 2 prenotazioni confermate
        Booking::factory()->count(2)->create([
            'lesson_slot_id' => $slot->id,
            'status' => 'confirmed',
        ]);

        // 1 prenotazione cancellata
        Booking::factory()->create([
            'lesson_slot_id' => $slot->id,
            'status' => 'cancelled',
        ]);

        $response = $this->actingAs($user)->get(route('lessons.index'));

        $lessons = $response->viewData('lessons');
        $loadedSlot = $lessons->first()->lessonSlots->first();

        $this->assertEquals(2, $loadedSlot->confirmed_bookings_count);
    }

    public function test_show_displays_active_lesson_details(): void
    {
        $user = User::factory()->create();
        $lesson = Lesson::factory()->create([
            'is_active' => true,
            'title' => 'Piano Basics',
        ]);

        $response = $this->actingAs($user)->get(route('lessons.show', $lesson));

        $response->assertOk();
        $response->assertViewIs('lessons.show');
        $response->assertSee('Piano Basics');
    }

    public function test_show_returns_404_for_inactive_lesson(): void
    {
        $user = User::factory()->create();
        $lesson = Lesson::factory()->create(['is_active' => false]);

        $response = $this->actingAs($user)->get(route('lessons.show', $lesson));

        $response->assertNotFound();
    }

    public function test_show_includes_confirmed_bookings_count(): void
    {
        $user = User::factory()->create();
        $lesson = Lesson::factory()->create(['is_active' => true]);
        $slot = LessonSlot::factory()->create([
            'lesson_id' => $lesson->id,
            'starts_at' => now()->addDay(),
            'ends_at' => now()->addDay()->addHour(),
        ]);

        Booking::factory()->count(3)->create([
            'lesson_slot_id' => $slot->id,
            'status' => 'confirmed',
        ]);

        Booking::factory()->create([
            'lesson_slot_id' => $slot->id,
            'status' => 'cancelled',
        ]);

        $response = $this->actingAs($user)->get(route('lessons.show', $lesson));

        $lesson = $response->viewData('lesson');
        $loadedSlot = $lesson->lessonSlots->first();

        $this->assertEquals(3, $loadedSlot->confirmed_bookings_count);
    }
}

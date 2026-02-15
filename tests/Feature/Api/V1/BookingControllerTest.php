<?php

namespace Tests\Feature\Api\V1;

use App\Models\Booking;
use App\Models\Lesson;
use App\Models\LessonSlot;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BookingControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_unauthenticated_user_cannot_access_bookings_api(): void
    {
        $response = $this->getJson('/api/v1/bookings');

        $response->assertUnauthorized();
    }

    public function test_authenticated_user_can_get_their_bookings(): void
    {
        $user = User::factory()->create();
        $lesson = Lesson::factory()->create(['title' => 'Piano Lesson']);
        $slot = LessonSlot::factory()->create([
            'lesson_id' => $lesson->id,
            'starts_at' => now()->addDay(),
            'ends_at' => now()->addDay()->addHour(),
        ]);

        Booking::factory()->create([
            'user_id' => $user->id,
            'lesson_slot_id' => $slot->id,
            'status' => 'confirmed',
            'note' => 'My booking note',
        ]);

        $response = $this->actingAs($user)
            ->getJson('/api/v1/bookings');

        $response->assertOk();
        $response->assertJsonCount(1, 'data');
        $response->assertJsonFragment([
            'status' => 'confirmed',
            'note' => 'My booking note',
        ]);
    }

    public function test_user_only_sees_their_own_bookings(): void
    {
        $user1 = User::factory()->create();
        $user2 = User::factory()->create();
        $lesson = Lesson::factory()->create();
        $slot = LessonSlot::factory()->create(['lesson_id' => $lesson->id]);

        // Prenotazioni di user1
        Booking::factory()->count(2)->create([
            'user_id' => $user1->id,
            'lesson_slot_id' => $slot->id,
        ]);

        // Prenotazioni di user2
        Booking::factory()->count(3)->create([
            'user_id' => $user2->id,
            'lesson_slot_id' => $slot->id,
        ]);

        $response = $this->actingAs($user1)
            ->getJson('/api/v1/bookings');

        $response->assertOk();
        $response->assertJsonCount(2, 'data');
    }

    public function test_bookings_are_ordered_by_latest_first(): void
    {
        $user = User::factory()->create();
        $lesson = Lesson::factory()->create();
        $slot = LessonSlot::factory()->create(['lesson_id' => $lesson->id]);

        $oldBooking = Booking::factory()->create([
            'user_id' => $user->id,
            'lesson_slot_id' => $slot->id,
            'created_at' => now()->subDays(5),
        ]);

        $newBooking = Booking::factory()->create([
            'user_id' => $user->id,
            'lesson_slot_id' => $slot->id,
            'created_at' => now(),
        ]);

        $response = $this->actingAs($user)
            ->getJson('/api/v1/bookings');

        $response->assertOk();
        $data = $response->json('data');

        $this->assertEquals($newBooking->id, $data[0]['id']);
        $this->assertEquals($oldBooking->id, $data[1]['id']);
    }

    public function test_booking_response_includes_slot_and_lesson_data(): void
    {
        $user = User::factory()->create();
        $lesson = Lesson::factory()->create([
            'title' => 'Guitar Advanced',
        ]);
        $slot = LessonSlot::factory()->create([
            'lesson_id' => $lesson->id,
            'starts_at' => now()->addDay()->setTime(14, 0),
            'ends_at' => now()->addDay()->setTime(15, 0),
        ]);

        Booking::factory()->create([
            'user_id' => $user->id,
            'lesson_slot_id' => $slot->id,
            'status' => 'confirmed',
        ]);

        $response = $this->actingAs($user)
            ->getJson('/api/v1/bookings');

        $response->assertOk();
        $response->assertJsonStructure([
            'data' => [
                '*' => [
                    'id',
                    'status',
                    'note',
                    'slot' => [
                        'id',
                        'starts_at',
                        'ends_at',
                    ],
                    'lesson' => [
                        'id',
                        'title',
                    ],
                ],
            ],
        ]);

        $response->assertJsonFragment([
            'title' => 'Guitar Advanced',
        ]);
    }

    public function test_api_uses_sanctum_authentication(): void
    {
        $user = User::factory()->create();
        $token = $user->createToken('test-token')->plainTextToken;
        $lesson = Lesson::factory()->create();
        $slot = LessonSlot::factory()->create(['lesson_id' => $lesson->id]);

        Booking::factory()->create([
            'user_id' => $user->id,
            'lesson_slot_id' => $slot->id,
        ]);

        $response = $this->withHeader('Authorization', 'Bearer ' . $token)
            ->getJson('/api/v1/bookings');

        $response->assertOk();
        $response->assertJsonCount(1, 'data');
    }

    public function test_cancelled_bookings_are_included_in_response(): void
    {
        $user = User::factory()->create();
        $lesson = Lesson::factory()->create();
        $slot = LessonSlot::factory()->create(['lesson_id' => $lesson->id]);

        Booking::factory()->create([
            'user_id' => $user->id,
            'lesson_slot_id' => $slot->id,
            'status' => 'confirmed',
        ]);

        Booking::factory()->create([
            'user_id' => $user->id,
            'lesson_slot_id' => $slot->id,
            'status' => 'cancelled',
        ]);

        $response = $this->actingAs($user)
            ->getJson('/api/v1/bookings');

        $response->assertOk();
        $response->assertJsonCount(2, 'data');
    }
}

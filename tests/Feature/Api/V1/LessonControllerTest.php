<?php

namespace Tests\Feature\Api\V1;

use App\Enums\LessonDifficultyLevel;
use App\Models\Lesson;
use App\Models\LessonSlot;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LessonControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_returns_all_active_lessons(): void
    {
        Lesson::factory()->count(3)->create(['is_active' => true]);
        Lesson::factory()->count(2)->create(['is_active' => false]);

        $response = $this->getJson('/api/v1/lessons');

        $response->assertOk();
        $response->assertJsonCount(3, 'data');
    }

    public function test_index_returns_lessons_ordered_by_title(): void
    {
        Lesson::factory()->create(['is_active' => true, 'title' => 'Zumba']);
        Lesson::factory()->create(['is_active' => true, 'title' => 'Bass']);
        Lesson::factory()->create(['is_active' => true, 'title' => 'Drums']);

        $response = $this->getJson('/api/v1/lessons');

        $response->assertOk();
        $data = $response->json('data');

        $this->assertEquals('Bass', $data[0]['title']);
        $this->assertEquals('Drums', $data[1]['title']);
        $this->assertEquals('Zumba', $data[2]['title']);
    }

    public function test_index_returns_correct_lesson_structure(): void
    {
        Lesson::factory()->create([
            'is_active' => true,
            'title' => 'Piano Basics',
            'instrument' => 'Piano',
            'difficulty_level' => LessonDifficultyLevel::Beginner,
            'duration_minutes' => 60,
            'teacher_name' => 'John Doe',
        ]);

        $response = $this->getJson('/api/v1/lessons');

        $response->assertOk();
        $response->assertJsonStructure([
            'data' => [
                '*' => [
                    'id',
                    'title',
                    'instrument',
                    'difficulty_level',
                    'duration_minutes',
                    'teacher_name',
                ],
            ],
        ]);

        $response->assertJsonFragment([
            'title' => 'Piano Basics',
            'instrument' => 'Piano',
            'duration_minutes' => 60,
            'teacher_name' => 'John Doe',
        ]);
    }

    public function test_index_does_not_include_description(): void
    {
        Lesson::factory()->create([
            'is_active' => true,
            'description' => 'This is a detailed description',
        ]);

        $response = $this->getJson('/api/v1/lessons');

        $response->assertOk();
        $data = $response->json('data');

        $this->assertArrayNotHasKey('description', $data[0]);
    }

    public function test_index_is_accessible_to_guests(): void
    {
        Lesson::factory()->create(['is_active' => true]);

        $response = $this->getJson('/api/v1/lessons');

        $response->assertOk();
    }

    public function test_show_returns_lesson_with_details(): void
    {
        $lesson = Lesson::factory()->create([
            'is_active' => true,
            'title' => 'Guitar Advanced',
            'description' => 'Advanced guitar techniques',
            'instrument' => 'Guitar',
            'difficulty_level' => LessonDifficultyLevel::Expert,
        ]);

        $response = $this->getJson("/api/v1/lessons/{$lesson->id}");

        $response->assertOk();
        $response->assertJsonStructure([
            'data' => [
                'id',
                'title',
                'instrument',
                'difficulty_level',
                'duration_minutes',
                'description',
                'teacher_name',
                'lessonSlots',
            ],
        ]);

        $response->assertJsonFragment([
            'title' => 'Guitar Advanced',
            'description' => 'Advanced guitar techniques',
        ]);
    }

    public function test_show_includes_description_field(): void
    {
        $lesson = Lesson::factory()->create([
            'is_active' => true,
            'description' => 'This is a detailed description',
        ]);

        $response = $this->getJson("/api/v1/lessons/{$lesson->id}");

        $response->assertOk();
        $response->assertJsonPath('data.description', 'This is a detailed description');
    }

    public function test_show_includes_only_non_cancelled_future_slots(): void
    {
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

        $response = $this->getJson("/api/v1/lessons/{$lesson->id}");

        $response->assertOk();
        $data = $response->json('data');

        $this->assertCount(1, $data['lessonSlots']);
        $this->assertEquals($futureSlot->id, $data['lessonSlots'][0]['id']);
    }

    public function test_show_slots_are_ordered_by_start_time(): void
    {
        $lesson = Lesson::factory()->create(['is_active' => true]);

        $slot3 = LessonSlot::factory()->create([
            'lesson_id' => $lesson->id,
            'starts_at' => now()->addDays(3),
            'ends_at' => now()->addDays(3)->addHour(),
        ]);

        $slot1 = LessonSlot::factory()->create([
            'lesson_id' => $lesson->id,
            'starts_at' => now()->addDay(),
            'ends_at' => now()->addDay()->addHour(),
        ]);

        $slot2 = LessonSlot::factory()->create([
            'lesson_id' => $lesson->id,
            'starts_at' => now()->addDays(2),
            'ends_at' => now()->addDays(2)->addHour(),
        ]);

        $response = $this->getJson("/api/v1/lessons/{$lesson->id}");

        $response->assertOk();
        $data = $response->json('data');

        $this->assertEquals($slot1->id, $data['lessonSlots'][0]['id']);
        $this->assertEquals($slot2->id, $data['lessonSlots'][1]['id']);
        $this->assertEquals($slot3->id, $data['lessonSlots'][2]['id']);
    }

    public function test_show_returns_404_for_nonexistent_lesson(): void
    {
        $response = $this->getJson('/api/v1/lessons/99999');

        $response->assertNotFound();
    }

    public function test_show_is_accessible_to_guests(): void
    {
        $lesson = Lesson::factory()->create(['is_active' => true]);

        $response = $this->getJson("/api/v1/lessons/{$lesson->id}");

        $response->assertOk();
    }
}

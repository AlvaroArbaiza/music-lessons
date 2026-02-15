<?php

namespace Database\Factories;

use App\Models\Lesson;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\LessonSlot>
 */
class LessonSlotFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $startsAt = fake()->dateTimeBetween('now', '+30 days');
        $durationMinutes = fake()->randomElement([30, 45, 60, 90]);

        return [
            'lesson_id' => Lesson::factory(),
            'starts_at' => $startsAt,
            'ends_at' => (clone $startsAt)->modify("+{$durationMinutes} minutes"),
            'max_students' => fake()->numberBetween(1, 10),
            'is_cancelled' => false,
        ];
    }

    /**
     * Indicate that the slot is cancelled.
     */
    public function cancelled(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_cancelled' => true,
        ]);
    }
}

<?php

namespace Database\Factories;

use App\Enums\LessonDifficultyLevel;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Lesson>
 */
class LessonFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(3),
            'instrument' => fake()->randomElement(['Piano', 'Guitar', 'Drums', 'Bass', 'Violin', 'Saxophone']),
            'teacher_name' => fake()->name(),
            'difficulty_level' => fake()->randomElement(LessonDifficultyLevel::cases()),
            'duration_minutes' => fake()->randomElement([30, 45, 60, 90]),
            'description' => fake()->paragraph(),
            'is_active' => true,
        ];
    }

    /**
     * Indicate that the lesson is inactive.
     */
    public function inactive(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_active' => false,
        ]);
    }
}

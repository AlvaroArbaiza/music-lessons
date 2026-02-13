<?php

namespace Database\Seeders;

use App\Models\Lesson;
use App\Models\LessonSlot;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MusicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $l1 = Lesson::create([
            'teacher_name' => 'Marco Rossi',
            'title' => 'Pianoforte Base',
            'instrument' => 'piano',
            'difficulty_level' => 'beginner',
            'duration_minutes' => 45,
            'description' => 'Impostazione, postura, prime scale e brani semplici.',
            'is_active' => true,
        ]);

        $l2 = Lesson::create([
            'teacher_name' => 'Giulia Bianchi',
            'title' => 'Chitarra Classica 1:1',
            'instrument' => 'guitar',
            'difficulty_level' => 'intermediate',
            'duration_minutes' => 60,
            'description' => 'Tecnica, arpeggi e repertorio personalizzato.',
            'is_active' => true,
        ]);

        foreach (range(1, 7) as $d) {
            $day = now()->addDays($d)->startOfDay();

            LessonSlot::create([
                'lesson_id' => $l1->id,
                'starts_at' => $day->copy()->setTime(18, 0),
                'ends_at' => $day->copy()->setTime(18, 45),
                'max_students' => 6,
            ]);

            LessonSlot::create([
                'lesson_id' => $l2->id,
                'starts_at' => $day->copy()->setTime(16, 0),
                'ends_at' => $day->copy()->setTime(17, 0),
                'max_students' => 1,
            ]);
        }
    }
}

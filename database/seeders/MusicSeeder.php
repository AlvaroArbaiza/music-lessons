<?php

namespace Database\Seeders;

use App\Models\Lesson;
use App\Models\LessonSlot;
use Illuminate\Database\Seeder;

class MusicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $lessons = [
            [
                'teacher_name' => 'Marco Rossi',
                'title' => 'Pianoforte Base',
                'instrument' => 'piano',
                'difficulty_level' => 'beginner',
                'duration_minutes' => 45,
                'description' => 'Impostazione, postura, prime scale e brani semplici. Perfetto per chi inizia da zero.',
                'is_active' => true,
                'slots' => 3,
                'max_students' => 6,
                'time_slots' => [
                    ['hour' => 17, 'minute' => 0],
                    ['hour' => 18, 'minute' => 0],
                    ['hour' => 19, 'minute' => 0],
                ],
            ],
            [
                'teacher_name' => 'Giulia Bianchi',
                'title' => 'Chitarra Classica 1:1',
                'instrument' => 'guitar',
                'difficulty_level' => 'intermediate',
                'duration_minutes' => 60,
                'description' => 'Tecnica, arpeggi e repertorio personalizzato. Lezione individuale.',
                'is_active' => true,
                'slots' => 2,
                'max_students' => 1,
                'time_slots' => [
                    ['hour' => 15, 'minute' => 0],
                    ['hour' => 16, 'minute' => 30],
                ],
            ],
            [
                'teacher_name' => 'Alessandro Verdi',
                'title' => 'Batteria Ritmo e Groove',
                'instrument' => 'drums',
                'difficulty_level' => 'intermediate',
                'duration_minutes' => 50,
                'description' => 'Tecnica, ritmi moderni, coordinazione e studio del groove. Piccoli gruppi.',
                'is_active' => true,
                'slots' => 2,
                'max_students' => 3,
                'time_slots' => [
                    ['hour' => 18, 'minute' => 30],
                    ['hour' => 20, 'minute' => 0],
                ],
            ],
            [
                'teacher_name' => 'Sofia Martini',
                'title' => 'Canto Lirico',
                'instrument' => 'voice',
                'difficulty_level' => 'expert',
                'duration_minutes' => 45,
                'description' => 'Tecnica vocale, repertorio lirico, respirazione e interpretazione. Per cantanti esperti.',
                'is_active' => true,
                'slots' => 1,
                'max_students' => 1,
                'time_slots' => [
                    ['hour' => 14, 'minute' => 0],
                ],
            ],
            [
                'teacher_name' => 'Luca Ferrari',
                'title' => 'Chitarra Elettrica Rock',
                'instrument' => 'guitar',
                'difficulty_level' => 'beginner',
                'duration_minutes' => 60,
                'description' => 'Accordi base, power chords, primi assoli e brani rock classici.',
                'is_active' => true,
                'slots' => 3,
                'max_students' => 4,
                'time_slots' => [
                    ['hour' => 16, 'minute' => 0],
                    ['hour' => 17, 'minute' => 15],
                    ['hour' => 18, 'minute' => 30],
                ],
            ],
            [
                'teacher_name' => 'Elena Conti',
                'title' => 'Violino Classico',
                'instrument' => 'violin',
                'difficulty_level' => 'beginner',
                'duration_minutes' => 40,
                'description' => 'Impostazione, arco, postura e prime melodie. Adatto anche ai bambini.',
                'is_active' => false,
                'slots' => 1,
                'max_students' => 2,
                'time_slots' => [
                    ['hour' => 10, 'minute' => 0],
                ],
            ],
            [
                'teacher_name' => 'Davide Romano',
                'title' => 'Basso Elettrico Funk',
                'instrument' => 'bass',
                'difficulty_level' => 'intermediate',
                'duration_minutes' => 55,
                'description' => 'Slap, walking bass, groove funk e studio delle linee di basso.',
                'is_active' => true,
                'slots' => 2,
                'max_students' => 2,
                'time_slots' => [
                    ['hour' => 19, 'minute' => 0],
                    ['hour' => 20, 'minute' => 15],
                ],
            ],
            [
                'teacher_name' => 'Francesca Marino',
                'title' => 'Pianoforte Jazz',
                'instrument' => 'piano',
                'difficulty_level' => 'expert',
                'duration_minutes' => 60,
                'description' => 'Armonia jazz, voicing, improvvisazione e studio degli standard.',
                'is_active' => false,
                'slots' => 1,
                'max_students' => 1,
                'time_slots' => [
                    ['hour' => 21, 'minute' => 0],
                ],
            ],
            [
                'teacher_name' => 'Roberto Galli',
                'title' => 'Teoria Musicale',
                'instrument' => 'theory',
                'difficulty_level' => 'beginner',
                'duration_minutes' => 90,
                'description' => 'Solfeggio, armonia, lettura spartiti e ear training. Corso collettivo.',
                'is_active' => true,
                'slots' => 1,
                'max_students' => 8,
                'time_slots' => [
                    ['hour' => 18, 'minute' => 0],
                ],
            ],
            [
                'teacher_name' => 'Chiara Ricci',
                'title' => 'Canto Pop Moderno',
                'instrument' => 'voice',
                'difficulty_level' => 'beginner',
                'duration_minutes' => 45,
                'description' => 'Tecnica vocale pop, interpretazione, microfono e repertorio contemporaneo.',
                'is_active' => true,
                'slots' => 3,
                'max_students' => 2,
                'time_slots' => [
                    ['hour' => 15, 'minute' => 30],
                    ['hour' => 16, 'minute' => 30],
                    ['hour' => 17, 'minute' => 30],
                ],
            ],
        ];

        foreach ($lessons as $lessonData) {
            $lesson = Lesson::create([
                'teacher_name' => $lessonData['teacher_name'],
                'title' => $lessonData['title'],
                'instrument' => $lessonData['instrument'],
                'difficulty_level' => $lessonData['difficulty_level'],
                'duration_minutes' => $lessonData['duration_minutes'],
                'description' => $lessonData['description'],
                'is_active' => $lessonData['is_active'],
            ]);

            // Crea slot per i prossimi giorni
            $slotsToCreate = min($lessonData['slots'], count($lessonData['time_slots']));

            for ($i = 0; $i < $slotsToCreate; $i++) {
                $dayOffset = rand(1, 10); 
                $day = now()->addDays($dayOffset)->startOfDay();
                $timeSlot = $lessonData['time_slots'][$i];

                LessonSlot::create([
                    'lesson_id' => $lesson->id,
                    'starts_at' => $day->copy()->setTime($timeSlot['hour'], $timeSlot['minute']),
                    'ends_at' => $day->copy()->setTime($timeSlot['hour'], $timeSlot['minute'])->addMinutes($lessonData['duration_minutes']),
                    'max_students' => $lessonData['max_students'],
                ]);
            }
        }
    }
}

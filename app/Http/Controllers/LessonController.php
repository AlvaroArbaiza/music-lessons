<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Lesson;
use Illuminate\Http\Request;

class LessonController extends Controller
{
    public function index()
    {
        // Lezioni attive con slot futuri non cancellati + conteggio prenotazioni confermate, ordinato e paginato
        $lessons = Lesson::query()
            ->where('is_active', true)
            ->with(['lessonSlots' => function ($q) {
                $q->where('is_cancelled', false)
                  ->where('starts_at', '>=', now())
                  ->withCount([
                      'bookings as confirmed_bookings_count' => fn($qq) => $qq->where('status', 'confirmed')
                  ])
                  ->orderBy('starts_at');
            }])
            ->orderBy('title')
            ->paginate(10);

        return view('lessons.index', compact('lessons'));
    }

    public function show(Lesson $lesson)
    {
        // Se non attiva, 404
        abort_unless($lesson->is_active, 404);

        // Slot futuri non cancellati + conteggio prenotazioni confermate, ordinati per starts_at
        $lesson->load(['lessonSlots' => function ($q) {
            $q->where('is_cancelled', false)
              ->where('starts_at', '>=', now())
              ->withCount([
                  'bookings as confirmed_bookings_count' => fn($qq) => $qq->where('status', 'confirmed')
              ])
              ->orderBy('starts_at');
        }]);

        return view('lessons.show', compact('lesson'));
    }
}

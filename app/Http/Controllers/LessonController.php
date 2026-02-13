<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Lesson;
use Illuminate\Http\Request;

class LessonController extends Controller
{
    public function index()
    {
        $lessons = Lesson::query()
            ->with('teacher')
            ->where('is_active', true)
            ->orderBy('title')
            ->paginate(10);

        return view('lessons.index', compact('lessons'));
    }

    public function show(Lesson $lesson)
    {
        $lesson->load(['teacher', 'slots' => function ($q) {
            $q->where('is_cancelled', false)
              ->where('starts_at', '>=', now())
              ->orderBy('starts_at');
        }]);

        return view('lessons.show', compact('lesson'));
    }
}

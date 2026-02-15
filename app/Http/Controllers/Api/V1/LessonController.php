<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\LessonDetailResource;
use App\Http\Resources\LessonResource;
use App\Models\Lesson;
use Illuminate\Http\Request;

class LessonController extends Controller
{
    public function index()
    {
        $lessons = Lesson::query()
            ->where('is_active', true)
            ->orderBy('title')
            ->paginate(10);

        return LessonResource::collection($lessons->items());
    }

    public function show(Lesson $lesson)
    {
        $lesson->load(['lessonSlots' => function ($q) {
            $q->where('is_cancelled', false)
              ->where('starts_at', '>=', now())
              ->orderBy('starts_at');
        }]);

        return new LessonDetailResource($lesson);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\LessonSlot;

class WelcomeController extends Controller
{
    public function index()
    {
        $upcomingSlots = LessonSlot::with('lesson')
            ->where('starts_at', '>', now())
            ->withCount(['bookings as confirmed_bookings_count' => function ($query) {
                $query->where('status', 'confirmed');
            }])
            ->orderBy('starts_at')
            ->limit(6)
            ->get();

        return view('welcome', compact('upcomingSlots'));
    }
}

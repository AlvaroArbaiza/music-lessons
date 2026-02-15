<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\BookingResource;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index(Request $request)
    {
        // Paginazione ordinata(dal più recente) con caricamento relazioni
        $bookings = $request->user()
            ->bookings()
            ->with(['lessonSlot.lesson'])
            ->latest()
            ->paginate(10);


        return BookingResource::collection($bookings->items());
    }
}

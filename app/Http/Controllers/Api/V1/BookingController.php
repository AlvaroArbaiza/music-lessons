<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBookingRequest;
use App\Http\Resources\BookingResource;
use App\Services\BookingService;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index(Request $request)
    {
        $bookings = $request->user()
            ->bookings()
            ->with(['slot.lesson'])
            ->latest()
            ->paginate(10);

        return BookingResource::collection($bookings);
    }

    public function store(StoreBookingRequest $request, BookingService $service)
    {
        $booking = $service->create(
            $request->user(),
            (int) $request->validated()['lesson_slot_id'],
            $request->validated()['note'] ?? null
        );

        $booking->load(['slot.lesson']);

        return (new BookingResource($booking))
            ->response()
            ->setStatusCode(201);
    }
}

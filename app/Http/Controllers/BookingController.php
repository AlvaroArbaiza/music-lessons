<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $bookings = $request->user()
            ->bookings()
            ->with(['slot.lesson.teacher'])
            ->latest()
            ->paginate(10);

        return view('bookings.index', compact('bookings'));
    }

    /*public function store(StoreBookingRequest $request, BookingService $service)
    {
        $service->create(
            $request->user(),
            (int) $request->validated()['lesson_slot_id'],
            $request->validated()['note'] ?? null
        );

        return back()->with('status', 'Prenotazione creata!');
    }*/

    /*public function destroy(Booking $booking)
    {
        $this->authorize('delete', $booking);
        $booking->update(['status' => 'cancelled']);

        return back()->with('status', 'Prenotazione annullata.');
    }*/
}

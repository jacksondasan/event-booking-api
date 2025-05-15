<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBookingRequest;
use App\Models\Booking;
use App\Models\Event;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class BookingController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBookingRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $event = Event::findOrFail($validated['event_id']);
        $ticketQuantity = $validated['ticket_quantity'] ?? 1;

        return DB::transaction(function () use ($validated, $event, $ticketQuantity) {
            $availableTickets = $event->getAvailableTickets();
            
            if ($availableTickets < $ticketQuantity) {
                return response()->json([
                    'message' => 'Not enough tickets available',
                    'available_tickets' => $availableTickets
                ], 422);
            }

            $booking = Booking::create([
                'event_id' => $validated['event_id'],
                'attendee_id' => $validated['attendee_id'],
                'ticket_quantity' => $ticketQuantity,
                'status' => 'confirmed',
                'booking_date' => now()
            ]);

            return response()->json([
                'message' => 'Booking confirmed successfully',
                'booking' => $booking,
                'remaining_tickets' => $event->getAvailableTickets()
            ], 201);
        });
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Booking $booking): JsonResponse
    {
        $booking->delete();

        return response()->json(null, 204);
    }
}

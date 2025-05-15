<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAttendeeRequest;
use App\Models\Attendee;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AttendeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): JsonResponse
    {
        $attendees = Attendee::query()
            ->when($request->search, function($query) use ($request) {
                return $query->where('name', 'like', "%{$request->search}%")
                    ->orWhere('email', 'like', "%{$request->search}%");
            })
            ->paginate($request->per_page ?? 15);

        return response()->json($attendees);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAttendeeRequest $request): JsonResponse
    {
        $attendee = Attendee::create($request->validated());

        return response()->json($attendee, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Attendee $attendee): JsonResponse
    {
        $attendee->load('bookings.event');
        
        return response()->json($attendee);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Attendee $attendee): JsonResponse
    {
        $attendee->delete();

        return response()->json(null, 204);
    }
}

<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEventRequest;
use App\Http\Requests\UpdateEventRequest;
use App\Models\Event;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use OpenApi\Annotations as OA;

/**
 * @OA\Info(
 *     title="Event Booking API",
 *     version="1.0.0",
 *     description="API for managing events and bookings"
 * )
 * 
 * @OA\Schema(
 *     schema="CreateEventRequest",
 *     required={"title", "description", "start_date", "end_date", "country", "venue", "capacity"},
 *     @OA\Property(property="title", type="string", example="Conference 2025"),
 *     @OA\Property(property="description", type="string", example="Annual tech conference"),
 *     @OA\Property(property="start_date", type="string", format="date-time", example="2025-06-01 10:00:00"),
 *     @OA\Property(property="end_date", type="string", format="date-time", example="2025-06-01 18:00:00"),
 *     @OA\Property(property="country", type="string", example="United States"),
 *     @OA\Property(property="venue", type="string", example="Convention Center"),
 *     @OA\Property(property="capacity", type="integer", example=100)
 * )
 * 
 * @OA\Schema(
 *     schema="UpdateEventRequest",
 *     @OA\Property(property="title", type="string"),
 *     @OA\Property(property="description", type="string"),
 *     @OA\Property(property="start_date", type="string", format="date-time"),
 *     @OA\Property(property="end_date", type="string", format="date-time"),
 *     @OA\Property(property="country", type="string"),
 *     @OA\Property(property="venue", type="string"),
 *     @OA\Property(property="capacity", type="integer")
 * )
 * 
 * @OA\SecurityScheme(
 *     securityScheme="bearerAuth",
 *     type="http",
 *     scheme="bearer"
 * )
 */
class EventController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/events",
     *     summary="List all events",
     *     tags={"Events"},
     *     @OA\Parameter(
     *         name="country",
     *         in="query",
     *         description="Filter events by country",
     *         required=false,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="date",
     *         in="query",
     *         description="Filter events by date (YYYY-MM-DD)",
     *         required=false,
     *         @OA\Schema(type="string", format="date")
     *     ),
     *     @OA\Parameter(
     *         name="per_page",
     *         in="query",
     *         description="Number of items per page",
     *         required=false,
     *         @OA\Schema(type="integer", default=15)
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="List of events"
     *     )
     * )
     */
    public function index(Request $request): JsonResponse
    {
        $perPage = $request->get('per_page', 15);
        
        $events = Event::query()
            ->when($request->country, function($query) use ($request) {
                return $query->where('country', $request->country);
            })
            ->when($request->date, function($query) use ($request) {
                return $query->whereDate('start_date', $request->date);
            })
            ->paginate($perPage);

        return response()->json($events);
    }

    /**
     * @OA\Post(
     *     path="/api/events",
     *     summary="Create a new event",
     *     tags={"Events"},
     *     security={{"bearerAuth": {}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"title","description","start_date","end_date","country","venue","capacity"},
     *             @OA\Property(property="title", type="string"),
     *             @OA\Property(property="description", type="string"),
     *             @OA\Property(property="start_date", type="string", format="date-time"),
     *             @OA\Property(property="end_date", type="string", format="date-time"),
     *             @OA\Property(property="country", type="string"),
     *             @OA\Property(property="venue", type="string"),
     *             @OA\Property(property="capacity", type="integer")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Event created successfully"
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation error"
     *     )
     * )
     */
    public function store(StoreEventRequest $request): JsonResponse
    {
        $event = Event::create($request->validated() + ['user_id' => auth()->id()]);
        return response()->json($event, 201);
    }

    /**
     * @OA\Get(
     *     path="/api/events/{id}",
     *     summary="Get event details",
     *     tags={"Events"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Event details"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Event not found"
     *     )
     * )
     */
    public function show(Event $event): JsonResponse
    {
        return response()->json([
            'event' => $event,
            'available_tickets' => $event->getAvailableTickets()
        ]);
    }

    /**
     * @OA\Put(
     *     path="/api/events/{id}",
     *     summary="Update event details",
     *     tags={"Events"},
     *     security={{"bearerAuth": {}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/UpdateEventRequest")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Event updated successfully"
     *     )
     * )
     */
    public function update(UpdateEventRequest $request, Event $event): JsonResponse
    {
        $event->update($request->validated());
        return response()->json($event);
    }

    /**
     * @OA\Delete(
     *     path="/api/events/{id}",
     *     summary="Delete an event",
     *     tags={"Events"},
     *     security={{"bearerAuth": {}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="Event deleted successfully"
     *     )
     * )
     */
    public function destroy(Event $event): JsonResponse
    {
        $event->delete();
        return response()->json(null, 204);
    }
}

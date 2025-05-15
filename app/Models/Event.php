<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'description',
        'start_date',
        'end_date',
        'country',
        'venue',
        'capacity',
        'user_id',
    ];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
    ];

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function attendees()
    {
        return $this->belongsToMany(Attendee::class, 'bookings')
            ->withPivot('status')
            ->withTimestamps();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function availableSpots()
    {
        return $this->capacity - $this->bookings()->where('status', 'confirmed')->count();
    }

    public function isFullyBooked(): bool
    {
        $totalBookings = $this->bookings()
            ->where('status', 'confirmed')
            ->sum('ticket_quantity');
        
        return $totalBookings >= $this->capacity;
    }

    public function getAvailableTickets(): int
    {
        $totalBookings = $this->bookings()
            ->where('status', 'confirmed')
            ->sum('ticket_quantity');
        
        return max(0, $this->capacity - $totalBookings);
    }
}

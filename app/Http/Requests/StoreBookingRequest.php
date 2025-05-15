<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreBookingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'event_id' => [
                'required',
                'exists:events,id',
                Rule::unique('bookings')
                    ->where('attendee_id', request('attendee_id'))
                    ->whereNull('deleted_at'),
            ],
            'attendee_id' => 'required|exists:attendees,id',
        ];
    }

    public function messages(): array
    {
        return [
            'event_id.unique' => 'You have already booked this event.',
        ];
    }
}

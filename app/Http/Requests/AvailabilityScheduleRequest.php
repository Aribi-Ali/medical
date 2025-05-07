<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AvailabilityScheduleRequest extends FormRequest
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
            'slotDuration' => 'nullable|numeric|min:1|max:60',
            'timeSlots' => 'nullable|array',
            'timeSlots.*.dayOfWeek' => 'required_with:timeSlots|string|in:SUNDAY,MONDAY,TUESDAY,WEDNESDAY,THURSDAY,FRIDAY,SATURDAY',
            'timeSlots.*.startTime' => 'required_with:timeSlots|date_format:H:i',
            'timeSlots.*.endTime' => 'required_with:timeSlots|date_format:H:i|after:timeSlots.*.startTime',
        ];
    }
}

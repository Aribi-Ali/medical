<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PharmacyRequest extends FormRequest
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
            "name" => "required|string|max:100",
            "city" => "required|string|max:255",
            "address" => "required|string|max:255",
            "timeSlots" => "required|array",
            'timeSlots.*.dayOfWeek' => 'required|string|in:SUNDAY,MONDAY,TUESDAY,WEDNESDAY,THURSDAY,FRIDAY,SATURDAY',
            'timeSlots.*.openTime' => 'required|string',
            'timeSlots.*.closeTime' => 'required|string',
        ];
    }
}

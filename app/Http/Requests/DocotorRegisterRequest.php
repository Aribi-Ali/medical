<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DocotorRegisterRequest extends FormRequest
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
            "name" => "required|string|min:3|max:50",
            "email" => "nullable|email|unique:users",
            "phone_number" => "required|string|min:10|max:10",
            "specialization" => "required|string|min:3|max:50",
            "address" => "required|string|min:3|max:50",
            "wilaya" => "required|string|min:3|max:50",
            "bio" => "nullable|string|min:3|max:500",
            "password" => "required|string|min:6|confirmed",
        ];
    }
}
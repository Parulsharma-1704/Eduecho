<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreTherapySessionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::user()?->hasPermissionTo('create_therapy_sessions') ?? false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'student_id' => 'required|exists:students,id',
            'therapist_id' => 'required|exists:users,id',
            'session_type' => 'required|in:physical,occupational,speech,behavioral',
            'session_date' => 'required|date',
            'duration' => 'required|integer|min:1|max:480',
            'notes' => 'nullable|string|max:2000',
            'progress' => 'nullable|string|max:1000',
        ];
    }

    public function messages(): array
    {
        return [
            'session_type.in' => 'Session type must be physical, occupational, speech, or behavioral.',
            'duration.max' => 'Session duration cannot exceed 8 hours (480 minutes).',
        ];
    }
}

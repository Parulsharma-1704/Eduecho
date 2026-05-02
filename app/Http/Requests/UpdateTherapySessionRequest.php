<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateTherapySessionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::user()?->hasPermissionTo('edit_therapy_sessions') ?? false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'student_id' => 'sometimes|exists:students,id',
            'therapist_id' => 'sometimes|exists:users,id',
            'session_type' => 'sometimes|string|in:SPEECH,OCCUPATIONAL,PHYSICAL,BEHAVIORAL',
            'session_date' => 'sometimes|date',
            'duration_minutes' => 'sometimes|integer|min:15|max:120',
            'progress_notes' => 'nullable|string|max:1000',
            'status' => 'sometimes|string|in:SCHEDULED,COMPLETED,CANCELLED',
        ];
    }
}

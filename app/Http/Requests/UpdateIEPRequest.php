<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateIEPRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::user()?->hasPermissionTo('edit_ieps') ?? false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'status' => 'sometimes|in:draft,active,completed',
            'academic_goals' => 'nullable|string|max:1000',
            'behavioral_goals' => 'nullable|string|max:1000',
            'therapy_goals' => 'nullable|string|max:1000',
            'review_date' => 'sometimes|date|after_or_equal:today',
            'notes' => 'nullable|string|max:2000',
        ];
    }
}

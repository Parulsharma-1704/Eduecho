<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateAssessmentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::user()?->hasPermissionTo('edit_assessments') ?? false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'sometimes|string|max:255',
            'description' => 'nullable|string|max:1000',
            'is_adaptive' => 'sometimes|boolean',
            'time_limit' => 'nullable|integer|min:1',
            'allow_extra_time' => 'sometimes|boolean',
            'allow_breaks' => 'sometimes|boolean',
            'allow_assistive_tech' => 'sometimes|boolean',
        ];
    }
}

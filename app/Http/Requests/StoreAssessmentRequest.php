<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreAssessmentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::user()?->hasPermissionTo('create_assessments') ?? false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'course_id' => 'required|exists:courses,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'is_adaptive' => 'boolean',
            'time_limit' => 'nullable|integer|min:1',
            'allow_extra_time' => 'boolean',
            'allow_breaks' => 'boolean',
            'allow_assistive_tech' => 'boolean',
        ];
    }

    public function messages(): array
    {
        return [
            'course_id.required' => 'Course is required.',
            'title.required' => 'Assessment title is required.',
        ];
    }
}

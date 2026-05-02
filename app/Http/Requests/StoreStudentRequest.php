<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreStudentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::user()?->hasPermissionTo('create_students') ?? false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'user_id' => 'required|exists:users,id|unique:students,user_id',
            'enrollment_date' => 'required|date',
            'is_active' => 'boolean',
        ];
    }

    public function messages(): array
    {
        return [
            'user_id.unique' => 'This user is already registered as a student.',
            'user_id.exists' => 'The specified user does not exist.',
        ];
    }
}

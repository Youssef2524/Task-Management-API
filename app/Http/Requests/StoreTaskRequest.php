<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTaskRequest extends FormRequest
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
            'title' => 'required|max:50',
            'description' => 'required',
            'priority' => 'required|in:low,medium,high',
            'due_date' => 'required|date_format:d-m-Y H:i',
            'status' => 'required|in:pending,in_progress,completed',
            'assigned_to' => 'nullable|exists:users,id',
        ];
    }
    public function messages()
{
    return [
        'due_date.date_format' => 'The due date field must match the format d-m-Y H:i.',
    ];
}
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTaskRequest extends FormRequest
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
            // 'title' => 'sometimes|required|max:255',
            // 'description' => 'sometimes|required',
            // 'priority' => 'sometimes|required|in:low,medium,high',
            // 'due_date' => 'sometimes|required|date_format:d-m-Y H:i',
            'status' => 'sometimes|required|in:pending,in_progress,completed',
        ];
    }
}

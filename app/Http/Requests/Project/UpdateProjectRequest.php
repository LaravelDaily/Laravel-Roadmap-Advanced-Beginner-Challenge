<?php

namespace App\Http\Requests\Project;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class UpdateProjectRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        if (Gate::allows('edit clients')) {
            return true;
        }
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'sometimes|string|max:200',
            'description' => 'sometimes|string',
            'deadline' => 'sometimes|date',
            'user_id' => 'sometimes|integer|exists:users,id',
            'client_id' => 'sometimes|integer|exists:clients,id',
            'status' => 'sometimes|boolean',
        ];
    }
}

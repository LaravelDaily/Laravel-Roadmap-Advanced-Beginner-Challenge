<?php

namespace App\Http\Requests\Project;

use Illuminate\Foundation\Http\FormRequest;

class CreateProjectRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:500',
            'deadline' => 'required|date|after:tomorrow',
            'user_id' => 'required|integer|exists:users,id',
            'client_id' => 'required|integer|exists:clients,id',
            'status' => 'required|string',
        ];
    }
}

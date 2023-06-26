<?php

namespace App\Http\Requests\Crm\Project;

use App\Enums\Project\ProjectStatusEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class UpdateRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string',
            'description' => 'required|string',
            'deadline' => 'required|date',
            'status' => [new Enum(ProjectStatusEnum::class)],
            'user_id' => 'required|integer|exists:users,id',
            'client_id' => 'required|integer|exists:clients,id'
        ];
    }
}

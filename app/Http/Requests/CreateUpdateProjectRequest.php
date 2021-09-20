<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateUpdateProjectRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'title'       => 'required|string',
            'description' => 'string',
            'deadline'    => 'required|date_format:Y-m-d',
            'client_id'   => 'required|integer|exists:clients,id',
            'user_id'     => 'required|integer|exists:users,id',
            'status_id'   => 'required|integer',
            'media'       => 'array',
            'media.*'     => 'string|distinct',
        ];
    }
}

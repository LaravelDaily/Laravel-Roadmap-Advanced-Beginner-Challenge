<?php

namespace App\Http\Requests;

use App\Rules\CheckEncryptedInput;
use Illuminate\Foundation\Http\FormRequest;

class AddResponseToTaskRequest extends FormRequest
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
            'content' => 'required',
            'task_id' => [
                'required',
                'string',
                new CheckEncryptedInput(),
            ],
            'media'       => 'array',
            'media.*'     => 'string|distinct',
        ];
    }
}

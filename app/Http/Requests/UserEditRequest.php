<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserEditRequest extends FormRequest
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
            'name' => 'required|string',
            'email' => [
                            'required',
                            'string',
                            Rule::unique('users')->ignore($this->user)
                        ],
            'role' => 'string'
        ];
    }

    /**
     * Customize the error messages
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => 'A name is required',
            'email.required' => 'An email address is required',
            'email.unique' => 'This email address is being used by anyone else...'
        ];
    }
}

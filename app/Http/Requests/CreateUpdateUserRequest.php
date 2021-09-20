<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateUpdateUserRequest extends FormRequest
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
        $rules = [
            'name'     => 'required|string',
            'email'    => [
                'required',
                'email:rfc,dns',
                Rule::unique('users')->ignore($this->route('user')),
            ],
            'is_admin' => 'boolean',
        ];

        if (
            $this->getMethod() === 'POST' ||
            $this->getMethod() === 'PUT' && $this->input('password') !== null
        ) {
            $rules['password'] = ['required', 'min:8', 'confirmed'];
        }

        return $rules;
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ClientRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'vat' => [
                'required',
                'numeric',
                'digits_between:1,5',
                Rule::unique('clients')->ignore($this->client)
            ],
            'address' => 'required|string|max:255',
            'state' => 'string|max:5'
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
            'vat.unique' => 'This VAT is being used by another client...',
            'vat.numeric' => 'VAT must be a number',
            'vat.digits_between' => 'VAT must have between 1 and 5 digits'
        ];
    }
}

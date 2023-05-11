<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ClientRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'first_name' => [
                'required',
                Rule::unique('clients')->ignore($this->client),
                'max:50'
            ],
            'last_name' => [
                'required',
                Rule::unique('clients')->ignore($this->client),
                'max:50'
            ],
            'company' => [
                'required',
                'max:100'
            ],
            'email' => [
                'required',
                Rule::unique('clients')->ignore($this->client),
                'email:rfc,dns'
            ],
            'phone' => [
                'required',
                Rule::unique('clients')->ignore($this->client),
                'max:20'
            ],
            'country' => [
                'required',
                'max:50'
            ],
            'client_status' => ['required'],
        ];
    }
}

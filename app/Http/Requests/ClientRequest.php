<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
                'unique',
                'max:50'
            ],
            'last_name' => [
                'required',
                'unique',
                'max:50'
            ],
            'company' => [
                'required',
                'max:100'
            ],
            'email' => [
                'required',
                'unique',
                'email:rfc,dns'
            ],
            'phone' => [
                'nullable',
                'unique',
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

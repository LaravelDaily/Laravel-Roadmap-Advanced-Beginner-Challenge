<?php

namespace App\Http\Requests\Client;

use Illuminate\Foundation\Http\FormRequest;

class UpdateClientRequset extends FormRequest
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
            'name' => 'required|string|max:50',
            'email' => 'required|string|email|max:100|unique:clients,email,'.$this->client->id,
            'phone_number' => 'required|string|max:15',
            'company_name' => 'required|string|max:30',
            'company_address' => 'required|string|max:255',
            'company_city' => 'required|string|max:30',
            'company_zip' => 'required|string|max:20',
            'company_vat' => 'required|numeric|digits_between:2,5',
        ];
    }
}

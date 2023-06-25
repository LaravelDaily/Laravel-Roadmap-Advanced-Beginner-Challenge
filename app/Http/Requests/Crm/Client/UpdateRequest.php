<?php

namespace App\Http\Requests\Crm\Client;

use Illuminate\Foundation\Http\FormRequest;

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
            'title_company' => 'required|string',
            'description_company' => 'string',
            'vat_company' => 'required|integer',
            'zip_company' => 'required|integer',
            'address_company' => 'required|string',
            'city_company' => 'required|string',
            'name_manager' => 'required|string',
            'email_manager' => 'required|string',
            'phone_manager' => 'required|string',
        ];
    }
}

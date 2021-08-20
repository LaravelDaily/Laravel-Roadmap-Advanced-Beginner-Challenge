<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Auth;


class ClientStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return (Auth::id() && (Auth::user()->hasRole('admin') ||
                (Auth::user()->hasRole('user') && (Auth::id() === (int) $this->created_by))
            )
        );
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'vat_id' => ['required', 'string', 'max:15', Rule::unique('clients', 'vat_id')->ignore($this->id, 'id')],
            'city' => ['required', 'string', 'max:50'],
            'zip_code' => ['required', 'string', 'max:10'],
            'address' => ['required', 'string', 'max:100'],
            'created_by' =>['nullable'],
        ];
    }
}

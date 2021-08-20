<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Auth;

class ProjectStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return (Auth::id() &&(Auth::user()->hasRole(['admin','user'])));
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'min:10'],
            'due_date'  => ['required', 'date'],
            'status' => ['required', 'numeric', 'max:1','min:0'],
            'user_id'   =>  ['required', 'numeric', 'exists:users,id'],
            'client_id'   =>  ['required', 'numeric', 'exists:clients,id'],
            'created_by' =>['nullable'],
            'logo'  => ['nullable','file','mimes:jpg,jpeg,png'],
        ];
    }
}

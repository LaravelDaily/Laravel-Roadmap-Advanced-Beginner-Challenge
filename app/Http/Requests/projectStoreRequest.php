<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class projectStoreRequest extends FormRequest
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
           'title'=>'required',
           'description'=>'required',
           'deadline'=>['required','date'],
           'assigned_user'=>'required',
           'assigned_client'=>'required',
           'department'=>'',
           'first_milestone'=>'',
           'second_milestone'=>'',
           'third_milestone'=>'',
        ];
    }
}

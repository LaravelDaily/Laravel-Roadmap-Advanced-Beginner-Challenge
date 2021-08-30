<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProjectRequest extends FormRequest
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
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'deadline' => 'required|after_or_equal:'.today(),
            'user_id' => 'required',
            'client_id' => 'required',
            'state_id' => 'nullable'
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
            'title.required' => 'A title is required',
            'title.max' => 'Title cannot exceed 255 characters',
            'description.required' => 'A description is required',
            'deadline.required' => 'A deadline is required',
            'deadline.after_or_equal' => 'Deadline cannot be a past date',
            'user_id.required' => 'An user is required',
            'client_id.required' => 'A client is required',
        ];
    }
}

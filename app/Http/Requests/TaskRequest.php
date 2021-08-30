<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaskRequest extends FormRequest
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
            'description'  => 'required|string|max:255',
            'deadline' => 'required|after_or_equal:'.today(),
            'user_id' => 'required',
            'project_id' => 'required',
            'state_id' => 'nullable'
        ];
    }

    /**
     * Customize validation error messages.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'title.max' => 'Title cannot exceed 255 characters',
            'description.max' => 'Title cannot exceed 255 characters',
            'deadline.after_or_equal' => 'Deadline cannot be a past date',
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FormValidationRequest extends FormRequest
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
            'email' => 'required|unique:customers,email|min:5|max:30',
            'name' => 'required|min:3|max:30',
            'image' => 'mimes:img,png,jpeg',
            'dob' => 'date|before:2015-01-01',
        ];
    }

    public function messages()
    {
        $messages = [
            'name.required' => 'We need to know your full name!',
            'name.min' => 'Name size must be between 5 and 30!',
            'name.max' => 'Name size must be between 5 and 30!',
            'email.required' => 'We need to know your email!',
            'email.unique' => 'Mail already exists',

        ];
        return $messages;
    }
}

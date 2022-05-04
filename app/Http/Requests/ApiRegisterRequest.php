<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ApiRegisterRequest extends FormRequest
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
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|max:32|regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!$#%]).*$/|',
            'name' => 'required|max:20'
        ];
    }

    public function messages()
    {
        return [
            'password.regex' => 'The password contains at lease one digits [0-9], uppercase character, lowercase character and !, $, # or %',
            'password.max' => 'The password contains max 32 characters',
            'password.min' => 'The password contains  min 8 characters'
        ];
    }

}

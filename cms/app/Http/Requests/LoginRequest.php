<?php

namespace App\Http\Requests;


class LoginRequest extends BaseFormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */

    protected $redirectRoute = 'index';

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
            'username' => 'required',
            'password' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'username.required' => 'Ingrese su email',
            'password.required' => 'Ingrese su contraseña'
        ];
    }

    public function filters()
    {
        return [
            'username' => 'trim|lowercase'
        ];
    }
}

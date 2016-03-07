<?php

namespace App\Http\Requests\User;

use App\Http\Requests\Request;

class Update extends Request
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
            'id' => 'required|integer',
            'name' => 'alpha',
            'email' => 'email',
            'password' => 'required',
            'password_confirmation' => 'required'
        ];
    }
}
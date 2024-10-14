<?php

namespace App\Http\Requests\UserAdministration;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
            'email' => 'required|unique:users,email,' . request()->segment(4),
            'name' => 'required|max:200',
            'role_id' => 'required',
            'password' => 'nullable|min:5|max:200',
            'verify_password' => 'same:password',
        ];
    }
}

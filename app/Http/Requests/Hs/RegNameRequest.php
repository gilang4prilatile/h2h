<?php

namespace App\Http\Requests\Hs;

use Illuminate\Foundation\Http\FormRequest;

class RegNameRequest extends FormRequest
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
            'description' => 'required|unique:master_hscode_bag,code,' . request()->segment(4),
        ];
    }
}

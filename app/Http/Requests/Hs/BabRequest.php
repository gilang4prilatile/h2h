<?php

namespace App\Http\Requests\Hs;

use Illuminate\Foundation\Http\FormRequest;

class BabRequest extends FormRequest
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
            'bab_eng' => 'required|max:200',
            'bab_ind' => 'required|max:200',
            'code' => 'max:20|required|unique:master_hscode_bab,code,' . request()->segment(4),
        ];
    }
}
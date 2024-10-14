<?php

namespace App\Http\Requests\Hs;

use Illuminate\Foundation\Http\FormRequest;

class PosRequest extends FormRequest
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
            'pos_eng' => 'required|max:200',
            'pos_ind' => 'required|max:200',
            'code' => 'max:20|required|unique:master_hscode_pos,code,' . request()->segment(4),
        ];
    }
}

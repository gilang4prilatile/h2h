<?php

namespace App\Http\Requests\Hs;

use Illuminate\Foundation\Http\FormRequest;

class SubPosAseanRequest extends FormRequest
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
            'sub_pos_asean_eng' => 'required|max:200',
            'sub_pos_asean_ind' => 'required|max:200',
            'code' => 'max:20|required|unique:master_hscode_sub_pos_asean,code,' . request()->segment(4),
        ];
    }
}

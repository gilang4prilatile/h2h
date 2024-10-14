<?php

namespace App\Http\Requests\Hs;

use Illuminate\Foundation\Http\FormRequest;

class HsCodeRequest extends FormRequest
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
            'hscode_bag_id' => 'required',
            'hscode_pos_id' => 'required',
            'hscode_sub_pos_id' => 'required',
            'description_ind' => 'required|max:4000',
            'description_eng' => 'required|max:4000',
        ];
    }
}

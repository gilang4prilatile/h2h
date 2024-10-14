<?php

namespace App\Http\Requests\Hs;

use Illuminate\Foundation\Http\FormRequest;

class RegulationRequest extends FormRequest
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
            'hs_code_id' => 'required',
            'hscode_reg_name_id' => 'required',
        ];
    }
}

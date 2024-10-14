<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePortRequest extends FormRequest
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
            'code' => 'required|max:255|unique:ports,code,',
            'country_id' => "required",
            "name" => "required|max:255",
            'master_kppbc_id' => "",
            "master_kppbc_code" => '',
            "details" => ""
        ];
    }
}

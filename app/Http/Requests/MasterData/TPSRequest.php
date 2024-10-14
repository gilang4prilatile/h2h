<?php

namespace App\Http\Requests\MasterData;

use Illuminate\Foundation\Http\FormRequest;

class TPSRequest extends FormRequest
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
            'code_office' => 'max:20|required|unique:master_tps,code_office,' . request()->segment(4),
            'code_warehouse' => 'max:20|required|unique:master_tps,code_warehouse,' . request()->segment(4),
            'name' => 'max:50|required',
            'alamat' => 'max:255|required'
        ];
    }
}

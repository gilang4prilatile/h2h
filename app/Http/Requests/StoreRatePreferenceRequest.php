<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRatePreferenceRequest extends FormRequest
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
            'code' => 'required|max:255',
            'name' => 'required|max:255',
            'regulation' => 'required|max:255',
            'date' => 'required',
            'fee_percentage' => 'required|numeric|between:0,9999999999.99'
        ];
    }
}

<?php

namespace App\Http\Requests\MasterData;

use Illuminate\Foundation\Http\FormRequest;

class TransportationRequest extends FormRequest
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
            'transport_line_id' => 'required',
            'description' => 'max:200',
            'name' => 'required|max:255',
            'code' => 'max:255|required|unique:transportations,code,' . request()->segment(4),
        ];
    }
}

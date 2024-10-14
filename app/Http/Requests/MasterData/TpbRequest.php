<?php

namespace App\Http\Requests\MasterData;

use Illuminate\Foundation\Http\FormRequest;

class TpbRequest extends FormRequest
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
            "identitas_id" => "required",
            'no_identitas' => 'required|max:25',
            'nama' => 'required|max:200',
            'alamat' => 'required|max:4000',
            'no_izin' => 'required|max:25',
        ];
    }
}

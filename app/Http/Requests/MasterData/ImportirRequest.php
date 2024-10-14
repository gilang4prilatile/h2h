<?php

namespace App\Http\Requests\MasterData;

use Illuminate\Foundation\Http\FormRequest;

class ImportirRequest extends FormRequest
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
            'identitas_id' => 'required|exists:master_identitas,id',
            'nomor_identitas' => 'required|max:100',
            'nama' => 'required|max:200',
            'alamat' => 'required|max:4000',
            'no_izin' => 'max:100',
        ];
    }
}

<?php

namespace App\Http\Requests;

use App\Rules\Identity;
use Illuminate\Foundation\Http\FormRequest;

class StoreProfileRequest extends FormRequest
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
            'name'                      => 'required',
            'details.tipe_identitas'    => 'required',
            'details.nomor_identitas'   => 'required',
            'country_id'                => 'required',
            'address'                   => 'required',
            'types'                     => 'required',
            'details.tipe_api'          => 'required',
            'details.nomor_api'         => 'required',
            'details.niper'             => 'required',
            'details.nomor_izin'        => 'required',
            'details.nomor_ppjk'        => '',
            'details.tanggal_ppjk'      => '',
            'details.warehouse_id'      => 'required'
        ];
    }
}

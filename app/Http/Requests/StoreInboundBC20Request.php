<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreInboundBC20Request extends FormRequest
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
             //'request_number' => 'required',
             //'nomor_pendaftaran' => 'required',
             //'tanggal_pendaftaran' => 'required',
             //'kppbc_id' => 'required',
             //'jenis_tpb_id' => 'required',
             // 'tujuan_pengiriman_id' => 'required',
            // 'tpb_id' => 'required',
            // 'pengirim_barang_id' => 'required',
            // 'jenis_sarana_pengangkutan_darat' => 'required',
            // 'nomor_polisi' => 'required',
            // 'harga_penyerahan' => 'required',
            // 'volume' => 'required',
            // 'berat_kotor' => 'required',
            // 'berat_bersih' => 'required',
            // 'list_barang' => 'required',
            // 'pabean_jabatan' => 'required',
            // 'pabean_tanggal' => 'required',
            // 'pabean_pemberitahu' => 'required',
            // 'inbound_packages' => 'required|array|min:1',
            // 'inbound_packages.*.*' => 'required',
            // 'inbound_documents' => 'required|array|min:1',
            // 'inbound_documents.*.*' => 'required',
        ];
    }

    public function messages()
    {
        return [
            //'kppbc_id.required' => 'The kantor pabean field is required',
            // 'jenis_tpb_id.required' => 'the jenis tpb field is required',
            // 'tujuan_pengiriman_id.required' => 'the tujuan pengiriman field is required',
            // 'tpb_id.required' => 'the pengusaha tpb field is required',
            // 'pengirim_barang_id.required' => 'the pengirim barang field is required',
            // 'inbound_packages.required' => 'the kemasan field is required',
            // 'inbound_packages.*.*.required' => 'the kemasan field is required',
            // 'inbound_documents.required' => 'the dokumen field is required',
            // 'inbound_documents.*.*.required' => 'the dokumen field is required',
        ];
    }
}

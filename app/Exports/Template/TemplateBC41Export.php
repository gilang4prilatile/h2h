<?php

namespace App\Exports\Template;

use App\Models\GoodConversion;
use App\Models\Inbound;
use App\Models\InboundDetail;
use App\Models\InventoryOutboundDetail;
use App\Models\InventoryOutDetail;
use App\Models\OutboundDocument;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class TemplateBC41Export implements WithMultipleSheets
{
    use Exportable;

    private $outbound;

    public function __construct($outbound){
        $this->outbound = $outbound;
    }

    /**
     * @return array
     */
    public function sheets(): array
    {

        $sheetsName = [
            'Header' => [
                'NOMOR AJU',
                'KPPBC',
                'PERUSAHAAN',
                'PEMASOK',
                'STATUS',
                'KODE DOKUMEN PABEAN',
                'NPPJK',
                'ALAMAT PEMASOK',
                'ALAMAT PEMILIK',
                'ALAMAT PENERIMA BARANG',
                'ALAMAT PENGIRIM',
                'ALAMAT PENGUSAHA',
                'ALAMAT PPJK',
                'API PEMILIK',
                'API PENERIMA',
                'API PENGUSAHA',
                'ASAL DATA',
                'ASURANSI',
                'BIAYA TAMBAHAN',
                'BRUTO',
                'CIF',
                'CIF RUPIAH',
                'DISKON',
                'FLAG PEMILIK',
                'URL DOKUMEN PABEAN',
                'FOB',
                'FREIGHT',
                'HARGA BARANG LDP',
                'HARGA INVOICE',
                'HARGA PENYERAHAN',
                'HARGA TOTAL',
                'ID MODUL',
                'ID PEMASOK',
                'ID PEMILIK',
                'ID PENERIMA BARANG',
                'ID PENGIRIM',
                'ID PENGUSAHA',
                'ID PPJK',
                'JABATAN TTD',
                'JUMLAH BARANG',
                'JUMLAH KEMASAN',
                'JUMLAH KONTAINER',
                'KESESUAIAN DOKUMEN',
                'KETERANGAN',
                'KODE ASAL BARANG',
                'KODE ASURANSI',
                'KODE BENDERA',
                'KODE CARA ANGKUT',
                'KODE CARA BAYAR',
                'KODE DAERAH ASAL',
                'KODE FASILITAS',
                'KODE FTZ',
                'KODE HARGA',
                'KODE ID PEMASOK',
                'KODE ID PEMILIK',
                'KODE ID PENERIMA BARANG',
                'KODE ID PENGIRIM',
                'KODE ID PENGUSAHA',
                'KODE ID PPJK',
                'KODE JENIS API',
                'KODE JENIS API PEMILIK',
                'KODE JENIS API PENERIMA',
                'KODE JENIS API PENGUSAHA',
                'KODE JENIS BARANG',
                'KODE JENIS BC25',
                'KODE JENIS NILAI',
                'KODE JENIS PEMASUKAN01',
                'KODE JENIS PEMASUKAN 02',
                'KODE JENIS TPB',
                'KODE KANTOR BONGKAR',
                'KODE KANTOR TUJUAN',
                'KODE LOKASI BAYAR',
                '',
                'KODE NEGARA PEMASOK',
                'KODE NEGARA PENGIRIM',
                'KODE NEGARA PEMILIK',
                'KODE NEGARA TUJUAN',
                'KODE PEL BONGKAR',
                'KODE PEL MUAT',
                'KODE PEL TRANSIT',
                'KODE PEMBAYAR',
                'KODE STATUS PENGUSAHA',
                'STATUS PERBAIKAN',
                'KODE TPS',
                'KODE TUJUAN PEMASUKAN',
                'KODE TUJUAN PENGIRIMAN',
                'KODE TUJUAN TPB',
                'KODE TUTUP PU',
                'KODE VALUTA',
                'KOTA TTD',
                'NAMA PEMILIK',
                'NAMA PENERIMA BARANG',
                'NAMA PENGANGKUT',
                'NAMA PENGIRIM',
                'NAMA PPJK',
                'NAMA TTD',
                'NDPBM',
                'NETTO',
                'NILAI INCOTERM',
                'NIPER PENERIMA',
                'NOMOR API',
                'NOMOR BC11',
                'NOMOR BILLING',
                'NOMOR DAFTAR',
                'NOMOR IJIN BPK PEMASOK',
                'NOMOR IJIN BPK PENGUSAHA',
                'NOMOR IJIN TPB',
                'NOMOR IJIN TPB PENERIMA',
                'NOMOR VOYV FLIGHT',
                'NPWP BILLING',
                'POS BC11',
                'SERI',
                'SUBPOS BC11',
                'SUB SUBPOS BC11',
                'TANGGAL BC11',
                'TANGGAL BERANGKAT',
                'TANGGAL BILLING',
                'TANGGAL DAFTAR',
                'TANGGAL IJIN BPK PEMASOK',
                'TANGGAL IJIN BPK PENGUSAHA',
                'TANGGAL IJIN TPB',
                'TANGGAL NPPPJK',
                'TANGGAL TIBA',
                'TANGGAL TTD',
                'TANGGAL JATUH TEMPO',
                'TOTAL BAYAR',
                'TOTAL BEBAS',
                'TOTAL DILUNASI',
                'TOTAL JAMIN',
                'TOTAL SUDAH DILUNASI',
                'TOTAL TANGGUH',
                'TOTAL TANGGUNG',
                'TOTAL TIDAK DIPUNGUT',
                'URL DOKUMEN PABEAN',
                'VERSI MODUL',
                'VOLUME',
                'WAKTU BONGKAR',
                'WAKTU STUFFING'
            ],
            'BahanBaku' => [
                'NOMOR AJU',
                'SERI BARANG',
                'SERI BAHAN BAKU',
                'CIF',
                'CIF RUPIAH',
                'HARGA PENYERAHAN',
                'HARGA PEROLEHAN',
                'JENIS SATUAN',
                'JUMLAH SATUAN',
                'KODE ASAL BAHAN BAKU',
                'KODE BARANG',
                'KODE FASILITAS',
                'KOZDE JENIS DOK ASAL',
                'KODE KANTOR',
                'KODE SKEMA TARIF',
                'KODE STATUS',
                'MERK',
                'NDPBM',
                'NETTO',
                'NOMOR AJU DOKUMEN ASAL',
                'NOMOR DAFTAR DOKUMEN ASAL',
                'POS TARIF',
                'SERI BARANG DOKUMEN ASAL',
                'SPESIFIKASI LAIN',
                'TANGGAL DAFTAR DOKUMEN ASAL',
                'TIPE',
                'UKURAN',
                'URAIAN'
            ],
            'BahanBakuTarif' => [
                'NOMOR AJU',
                'SERI BARANG',
                'SERI BAHAN BAKU',
                'JENIS TARIF',
                'JUMLAH SATUAN',
                'KODE ASAL BAHAN BAKU',
                'KODE FASILITAS',
                'KODE KOMODITI CUKAI',
                'KODE SATUAN',
                'KODE TARIF',
                'NILAI BAYAR',
                'NILAI FASILITAS',
                'NILAI SUDAH DILUNASI',
                'TARIF',
                'TARIF FASILITAS'
            ],
            'BahanBakuDokumen' => [
                'NOMOR AJU',
                'SERI BARANG',
                'SERI BAHAN BAKU',
                'SERI DOKUMEN',
                'KODE ASAL BAHAN BAKU',

            ],
            'Barang' => [
                'NOMOR AJU',
                'SERI BARANG',
                'ASURANSI',
                'CIF',
                'CIF RUPIAH',
                'DISKON',
                'FLAG KENDARAAN',
                'FOB',
                'FREIGHT',
                'BARANG BARANG LDP',
                'HARGA INVOICE',
                'HARGA PENYERAHAN',
                'HARGA SATUAN',
                'JENIS KENDARAAN',
                'JUMLAH BAHAN BAKU',
                'JUMLAH KEMASAN',
                'JUMLAH SATUAN',
                'KAPASITAS SILINDER',
                'KATEGORI BARANG',
                'KODE_ASAL BARANG',
                'KODE BARANG',
                'KODE FASILITAS',
                'KODE GUNA',
                'KODE JENIS NILAI',
                'KODE KEMASAN',
                'KODE LEBIH DARI 4 TAHUN',
                'KODE NEGARA ASAL',
                'KODE SATUAN',
                'KODE SKEMA TARIF',
                '',
                'KONDISI BARANG',
                'MERK',
                'NETTO',
                'NILAI INCOTERM',
                'NILAI PABEAN',
                'NOMOR MESIN',
                'POS TARIF',
                'SERI POS TARIF',
                'SPESIFIKASI LAIN',
                'TAHUN PEMBUATAN',
                'TIPE',
                'UKURAN',
                'URAIAN',
                'VOLUME',
                'SERI IJIN'
            ],
            'BarangTarif' => [
                'NOMOR AJU',
                'SERI BARANG',
                'JENIS TARIF',
                'JUMLAH SATUAN',
                'KODE FASILITAS',
                'KODE KOMODITI CUKAI',
                'TARIF KODE SATUAN',
                'TARIF KODE TARIF',
                'TARIF NILAI BAYAR',
                'TARIF NILAI FASILITAS',
                'TARIF NILAI SUDAH DILUNASI',
                'TARIF',
                'TARIF FASILITAS'
            ],
            'BarangDokumen' => [
                'NOMOR AJU',
                'SERI BARANG',
                'SERI DOKUMEN'
            ],
            'Dokumen' => [
                'NOMOR AJU',
                'SERI DOKUMEN',
                'FLAG URL DOKUMEN',
                'KODE JENIS DOKUMEN',
                'NOMOR DOKUMEN',
                'TANGGAL DOKUMEN',
                'TIPE DOKUMEN',
                'URL DOKUMEN'
            ],
            'Kemasan' => [
                'NOMOR AJU',
                'SERI KEMASAN',
                'JUMLAH KEMASAN',
                'KESESUAIAN DOKUMEN',
                'KETERANGAN',
                'KODE JENIS KEMASAN',
                'MEREK KEMASAN',
                'NIP GATE IN',
                'NIP GATE OUT',
                'NOMOR POLISI',
                'NOMOR SEGEL',
                'WAKTU GATE IN',
                'WAKTU GATE OUT'
            ],
            'Kontainer' => [
                'NOMOR AJU',
                'SERI KONTAINER',
                'KESESUAIAN DOKUMEN',
                'KETERANGAN',
                'KODE STUFFING',
                'KODE TIPE KONTAINER',
                'KODE UKURAN KONTAINER',
                'FLAG GATE IN',
                'FLAG GATE OUT',
                'NOMOR POLISI',
                'NOMOR KONTAINER',
                'NOMOR SEGEL',
                'WAKTU GATE IN',
                'WAKTU GATE OUT'
            ],
            'Respon' => [
                'NOMOR AJU',
                'KODE RESPON',
                'NOMOR RESPON',
                'TANGGAL RESPON',
                'WAKTU RESPON',
                'BYTE STRAM PDF'
            ],
            'Status' => [
                'NOMOR AJU',
                'KODE RESPON',
                'NOMOR RESPON'
            ]
        ];

        $sheets = [];
        $data = [];
        $keys = array_keys($sheetsName);

        $jumlahbarang = $this->outbound->outboundDetails;
        $jumlahbar = 0;
        $jumlahkem = 0;
        $jeniskem = '';
        foreach ($jumlahbarang as $barang) {
            $jumlahbar += $barang->quantity;
            $jumlahkem += $barang->package_details['jumlah'];
            $jeniskem.=$barang->package_details['merk'].' ';
        }

        foreach($keys as $key){

            $data = [];

            if($key == 'Dokumen'){

                $inbounds = [];
                $countDoc = count($this->outbound->outboundDocuments);

                foreach($this->outbound->outboundDocuments as $ind=>$outboundDocument){

                    $data[$ind]['nomer_aju'] = $this->outbound->request_number ?? '';
                    $data[$ind]['seri_dokumen'] = $outboundDocument->seri_document ?? '';
                    $data[$ind]['flag_url_dokumen'] = '';
                    $data[$ind]['kode_jenis_dokumen'] = $outboundDocument->document_id ?? '';
                    $data[$ind]['nomor_dokumen'] = $outboundDocument->details['nomor_dokumen'] ?? '';
                    $data[$ind]['tanggal_dokumen'] = $outboundDocument->details['date'] ?? '';
                    $data[$ind]['tipe_dokumen'] = $outboundDocument->masterDocument->name ?? '';
                    $data[$ind]['url_dokumen'] = '';

                }

                foreach($this->outbound->inventoryOutboundDetail as $inventoryOutboundDetail){
                    if(!in_array($inventoryOutboundDetail->inbound_id, $inbounds)){
                        $inbounds[] = $inventoryOutboundDetail->inbound_id;
                    }
                }
                
                foreach($inbounds as $keyInbound=>$inbound){

                    $inbound = Inbound::find($inbound);
                    $ind = ( $keyInbound + 1 ) + $countDoc;
                    $data[$ind]['nomer_aju'] = $this->outbound->request_number ?? '';
                    $data[$ind]['seri_dokumen'] = $ind ?? '';
                    $data[$ind]['flag_url_dokumen'] = '';
                    $data[$ind]['kode_jenis_dokumen'] = $outboundDocument->document_id ?? '';
                    $data[$ind]['nomor_dokumen'] = $inbound->request_number ?? '';
                    $data[$ind]['tanggal_dokumen'] = date("Y-m-d", strtotime($inbound->created_at));
                    $data[$ind]['tipe_dokumen'] = 'BC 40';
                    $data[$ind]['url_dokumen'] = '';
                }


            }

            if($key == 'Header'){
                $kodenegarapengirim = DB::table('countries')->where('id','=', $this->outbound->outboundPengirimBarang->profile->country_id)->first();

                $arrSementara = [
                    'NOMOR AJU' => $this->outbound->request_number ?? '',
                    'KPPBC' => $this->outbound->outboundKppbc->masterKppbc->code ?? '',
                    'PERUSAHAAN' => $this->outbound->outboundTpb->profile->name ?? '',
                    'STATUS' => 1,
                    'KODE DOKUMEN PABEAN' => $this->outbound->bcForm->name ?? '',
                    'ALAMAT PENGUSAHA' => $this->outbound->outboundTpb->profile->address ?? '',
                    'CIF' => $this->outbound->outboundDetails[0]->details['harga_cif'] ?? '',
                    'CIF RUPIAH' => $this->outbound->outboundDetails[0]->details['cif_rp'] ?? '',
                    'BRUTO' => $this->outbound->details['berat_kotor'] ?? '',
                    'HARGA PENYERAHAN' => $this->outbound->details['harga_penyerahan'] ?? '',
                    'KODE JENIS TPB' => $this->outbound->outboundJenisTpb->masterJenisTpb->code ?? '',
                    'NAMA PENGANGKUT' => $this->outbound->outboundTransportation->transportation->name ?? '',
                    'NAMA TTD' => $this->outbound->details['pabean_pemberitahu'] ?? '',
                    'FREIGHT' => $this->outbound->outboundDetails[0]->details['freight'] ?? '',
                    'KODE CARA ANGKUT' => $this->outbound->outboundTransportLine->transportLine->id ?? '',
                    'API PENGUSAHA' => $this->outbound->outboundTpb->profile->details['nomor_api'] ?? '',
                    'NETTO' => $this->outbound->details['berat_bersih'] ?? '',
                    'FOB' => $this->outbound->outboundDetails[0]->details['fob'] ?? '',
                    'NOMOR IJIN TPB' => $this->outbound->outboundTpb->profile->details['nomor_izin'] ?? '',
                    'TANGGAL TTD' => $this->outbound->details['pabean_tanggal'] ?? '',
                    'WAKTU BONGKAR' => $this->outbound->details['volume'] ?? '', //Volume
                    'KODE TUJUAN PENGIRIMAN' => $this->outbound->outboundTujuanPengiriman->masterTujuanPengiriman->code ?? '',
                    'ALAMAT PENGIRIM' => $this->outbound->outboundPengirimBarang->profile->address ?? '',
                    'ID PENGIRIM' => $this->outbound->outboundPengirimBarang->profile->id ?? '',
                    'ID PENGUSAHA' => $this->outbound->outboundTpb->profile->id ?? '',
                    'JABATAN TTD' => $this->outbound->details['pabean_jabatan'] ?? '',
                    'KODE NEGARA PENGIRIM' => $kodenegarapengirim->code ?? '',
                    'KOTA TTD' => $this->outbound->city->city ?? '',
                    'NAMA PENGIRIM' => $this->outbound->outboundPengirimBarang->profile->name ?? '',
                    'JUMLAH BARANG' => $jumlahbar ,
                    'JUMLAH KEMASAN' => $jumlahkem,

                ];

                for($i = 0 ; $i < count($sheetsName['Header']) ; $i++){

                    $keySementara = array_keys($arrSementara);
                    foreach($keySementara as $keySem){

                        if($sheetsName['Header'][$i] === $keySem){
                            $data[0][$sheetsName['Header'][$i]] = $arrSementara[$keySem];
                            break;
                        }

                        $data[0][$sheetsName['Header'][$i]] = '';
                    }
                }

            }

            if($key == 'BahanBaku'){
                $barandInd=0;
                $seriBarang=0;
                foreach($this->outbound->outboundDetails as $outboundDetail) {
                    $seriBarang++;
                    foreach ($outboundDetail->good->goodConversions as $goodConversion) {

                        $inventoryOutboundDetailBB = InventoryOutboundDetail::where('good_id', $goodConversion->good_conversion_id)
                                                    ->where('outbound_detail_id', $outboundDetail->id)
                                                    ->where('outbound_id', $this->outbound->id)
                                                    ->get(); 

                        $hargaPenyerahan = 0;
                        foreach($inventoryOutboundDetailBB as $vl){

                            if($vl->inbound_detail_id != null){
                                $inboundDetail = InboundDetail::find($vl->inbound_detail_id);
                                $hargaPenyerahan += ( $inboundDetail->details['harga_penyerahan'] ?? 0 / $inboundDetail->quantity ) * $vl->quantity_good_conversion;
                            }else {
                                // $inventoryOutDetail = InventoryOutDetail::find($vl->inventory_out_detail_id);
                                $hargaPenyerahan += 0 * $vl->quantity_good_conversion;
                            }

                           
                        }
                        

                        $barandInd++;
                        $arrSementara = [
                            'NOMOR AJU' => $this->outbound->request_number ?? '',
                            'KODE BARANG' => $goodConversion->rawGood->details['kode_barang'],
                            'SERI BARANG' => $seriBarang,
                            'SERI BAHAN BAKU' => $barandInd,
                            'HARGA PENYERAHAN' => $hargaPenyerahan ?? '',
                            'CIF' => $outboundDetail->details['harga_cif'] ?? '',
                            'CIF RUPIAH' => $outboundDetail->details['cif_rp'] ?? '',
                            'UKURAN' => $goodConversion->rawGood->details['ukuran'] ?? '',
                            'URAIAN' =>  $goodConversion->rawGood->details['uraian'] ?? '',
                            'SPESIFIKASI LAIN' =>  $goodConversion->rawGood->details['spesifikasi_lain'] ?? '',
                            'MERK' => $goodConversion->rawGood->details['merk'] ?? '',
                            'NETTO'=> $goodConversion->rawGood->nett_weight ?? '',
                            'TIPE' => $goodConversion->rawGood->details['type'] ?? '',
                            'JENIS SATUAN' => $goodConversion->rawGood->uom->name ?? '',
                            'JUMLAH SATUAN' => $goodConversion->quanitity ?? '',
                        ];

                        for($i = 0 ; $i < count($sheetsName['BahanBaku']) ; $i++){

                            $keySementara = array_keys($arrSementara);

                            foreach($keySementara as $keySem){

                                if($sheetsName['BahanBaku'][$i] === $keySem){
                                    $data[$barandInd][$sheetsName['BahanBaku'][$i]] = $arrSementara[$keySem];
                                    break;
                                }

                                $data[$barandInd][$sheetsName['BahanBaku'][$i]] = '';
                            }
                        }

                    }

                }

            }


            if($key == 'BahanBakuDokumen') {
                $barandInd = 0;
                $inbounds = [];
                $documents = [];

                $outboundDocumentsDB = $this->outbound->outboundDocuments;
    
                foreach($outboundDocumentsDB as $outboundDocument){
                    $documents[] = $outboundDocument->seri_document;
                }
            
                foreach($this->outbound->inventoryOutboundDetail as $inventoryOutboundDetail){
                    if(!in_array($inventoryOutboundDetail->inbound_id, $inbounds)){
                        $inbounds[] = $inventoryOutboundDetail->inbound_id;
                    }
                }
                
                $outboundDocumentWithInbounds = array_merge($documents, $inbounds);
            
                foreach($this->outbound->outboundDetails as $keyOutboundDetail=>$outboundDetail){
                    $goodConversions = GoodConversion::where('good_id', $outboundDetail->good_id)->get();
                    foreach($goodConversions as $keyGood=>$goodConversion){
                        $outboundDocuments = OutboundDocument::where('outbound_detail_id', $outboundDetail->id)->get();
                        foreach($outboundDocumentWithInbounds as $keySeriDoc=>$outboundDocumentWithInbound){
                          
                            foreach($outboundDocuments as $outboundDocument){

                                if($outboundDocument->seri_document == ( $keySeriDoc + 1 ) && ($keySeriDoc + 1 ) <= count($documents)){
                                    $barandInd++;
                                    $arrSementara = [
                                        'NOMOR AJU' => $this->outbound->request_number ?? '',
                                        'SERI BARANG' => ( $keyOutboundDetail + 1 ) ?? '',
                                        'SERI BAHAN BAKU' => ($keyGood + 1) ?? '',
                                        'SERI DOKUMEN' => ( $keySeriDoc + 1 ) ?? '',
                                    ];
                                    for ($i = 0; $i < count($sheetsName['BahanBakuDokumen']); $i++) {
    
                                        $keySementara = array_keys($arrSementara);
                                        foreach ($keySementara as $keySem) {
                                            if ($sheetsName['BahanBakuDokumen'][$i] === $keySem) {
                                                $data[$barandInd][$sheetsName['BahanBakuDokumen'][$i]] = $arrSementara[$keySem];
                                                break;
                                            }
    
                                            $data[$barandInd][$sheetsName['BahanBakuDokumen'][$i]] = '';
    
    
                                        }
                                    }

                                    break;
                                
                                }else if(($keySeriDoc + 1 ) > count($documents) && InventoryOutboundDetail::where('inbound_id', $outboundDocumentWithInbound)
                                            ->where('outbound_id', $this->outbound->id)
                                            ->where('outbound_detail_id', $outboundDetail->id)
                                            ->where('good_id', $goodConversion->good_conversion_id)
                                            ->count() > 0) {
    
                                    $barandInd++;
                                    $arrSementara = [
                                        'NOMOR AJU' => $this->outbound->request_number ?? '',
                                        'SERI BARANG' => ( $keyOutboundDetail + 1 ) ?? '',
                                        'SERI BAHAN BAKU' => ($keyGood + 1) ?? '',
                                        'SERI DOKUMEN' => ( $keySeriDoc + 1 ) ?? '',
                                    ];
    
                                    for ($i = 0; $i < count($sheetsName['BahanBakuDokumen']); $i++) {
    
                                        $keySementara = array_keys($arrSementara);
                                        foreach ($keySementara as $keySem) {
                                            if ($sheetsName['BahanBakuDokumen'][$i] === $keySem) {
                                                $data[$barandInd][$sheetsName['BahanBakuDokumen'][$i]] = $arrSementara[$keySem];
                                                break;
                                            }
    
                                            $data[$barandInd][$sheetsName['BahanBakuDokumen'][$i]] = '';
    
    
                                        }
                                    }

                                    break;

                                }

                            }
            
                        }
            
            
            
                    }
                }
                

                // foreach($this->outbound->inventoryOutboundDetail as $inventoryOutboundDetail){
                //     if(!in_array($inventoryOutboundDetail->inbound->id, $inbounds)){
                //         $inbounds[] = $inventoryOutboundDetail->inbound->id;
                //     }
                // }
            
                // foreach ($this->outbound->outboundDocumentsExcel as $outboundDocument) {
                //     for($i = 0 ; $i < count($inbounds) ; $i++){
                //         $inbound = Inbound::find($inbounds[$i]);
                //         foreach($inbound->inboundDocumentsExcel as $inboundDocument){
                //             $outboundDocument2 = $this->outbound->outboundDocuments;
                //             for($x = 0 ; $x < ( count($outboundDocument2) + count($inbounds) ) ; $x++){
                //                 $barandInd++;
                //                 $arrSementara = [
                //                     'NOMOR AJU' => $this->outbound->request_number ?? '',
                //                     'SERI BARANG' => $outboundDocument->seri_barang ?? '',
                //                     'SERI BAHAN BAKU' => $inboundDocument->seri_barang ?? '',
                //                     'SERI DOKUMEN' => $outboundDocument2[$x]->seri_document ?? ( $x + 1 ),
                
                //                 ];

                //                 for ($i = 0; $i < count($sheetsName['BahanBakuDokumen']); $i++) {

                //                     $keySementara = array_keys($arrSementara);
                //                     foreach ($keySementara as $keySem) {
                //                         if ($sheetsName['BahanBakuDokumen'][$i] === $keySem) {
                //                             $data[$barandInd][$sheetsName['BahanBakuDokumen'][$i]] = $arrSementara[$keySem];
                //                             break;
                //                         }

                //                         $data[$barandInd][$sheetsName['BahanBakuDokumen'][$i]] = '';


                //                     }
                //                 }

            
                //             }
            
                //         }
            
                //     }
            
                // }


            }

            if($key == 'Barang'){
                    $barandInd = 0;

                foreach($this->outbound->outboundDetails as $outboundDetail) {

                    $jumlahbahanbaku = 0;

                    foreach ($outboundDetail->good->goodConversions as $goodConversion) {
                        $jumlahbahanbaku++;
                    }

                    $barandInd++;
                    $arrSementara = [
                        'NOMOR AJU' => $this->outbound->request_number ?? '',
                        'HARGA PENYERAHAN' => $this->outbound->details['harga_penyerahan'] ?? '',
                        'JUMLAH SATUAN' => $outboundDetail->quantity ?? '',
                        'KODE BARANG' => $outboundDetail->details['kode_barang'] ?? '',
                        'CIF' => $outboundDetail['harga_cif'] ?? '',
                        'CIF RUPIAH' => $outboundDetail['cif_rp'] ?? '',
                        'KODE SATUAN' => $outboundDetail->good->uom->code ?? '',
                        'MERK' => $outboundDetail->details['merk'] ?? '',
                        'NETTO' => $outboundDetail->nett_weight ?? '',
                        'TIPE' => $outboundDetail->details['type'] ?? '',
                        'URAIAN' => $outboundDetail->details['uraian'] ?? '',
                        'VOLUME' => $outboundDetail->volume ?? '',
                        'UKURAN' => $outboundDetail->details['ukuran'] ?? '',
                        'SPESIFIKASI LAIN' => $outboundDetail->details['spesifikasi_lain'] ?? '',
                        'SERI BARANG' => $barandInd,
                        'KODE KEMASAN' => $outboundDetail->package->code ?? '',
                        'JUMLAH KEMASAN' => $jumlahkem,
                        'JUMLAH BAHAN BAKU' => $jumlahbahanbaku,
                        'JENIS KENDARAAN' => $this->outbound->outboundTransportLine->transportLine->name ?? '',
                    ];


                    for ($i = 0; $i < count($sheetsName['Barang']); $i++) {

                        $keySementara = array_keys($arrSementara);
                        foreach ($keySementara as $keySem) {

                            if ($sheetsName['Barang'][$i] === $keySem) {
                                $data[$barandInd][$sheetsName['Barang'][$i]] = $arrSementara[$keySem];
                                break;
                            }

                            $data[$barandInd][$sheetsName['Barang'][$i]] = '';
                        }
                    }
                }
            }

            if($key == 'BarangDokumen'){

                foreach($this->outbound->outboundDocuments as $barandInd=>$outboundDocument){

                    $arrSementara = [
                        'NOMOR AJU' => $this->outbound->request_number ?? '',
                        'SERI BARANG' => $outboundDocument->seri_barang ?? 0,
                        'SERI DOKUMEN' => $outboundDocument->seri_document ?? 0,

                    ];

                    for($i = 0 ; $i < count($sheetsName['BarangDokumen']) ; $i++){

                        $keySementara = array_keys($arrSementara);
                        foreach($keySementara as $keySem){

                            if($sheetsName['BarangDokumen'][$i] === $keySem){
                                $data[$barandInd][$sheetsName['BarangDokumen'][$i]] = $arrSementara[$keySem];
                                break;
                            }

                            $data[$barandInd][$sheetsName['BarangDokumen'][$i]] = '';
                        }
                    }

                }

            }

            if($key == 'Kemasan'){
                $barandInd = 0;

                foreach($this->outbound->outboundDetails as $outboundDetail){

                    foreach ($this->outbound->outboundDocuments as $outboundDocument){
                        $barandInd++;
                        $arrSementara = [
                            'NOMOR AJU' => $this->outbound->request_number ?? '',
                            'JUMLAH KEMASAN' => $outboundDetail->package_details['jumlah'] ?? '',
                            'KODE JENIS KEMASAN' => $outboundDetail->package->code ?? '',
                            'MEREK KEMASAN' => $outboundDetail->package_details['merk'] ?? '',
                            'NOMOR POLISI' => $outboundDocument->vehicle_number ?? '',
                        ];

                        for($i = 0 ; $i < count($sheetsName['Kemasan']) ; $i++){

                            $keySementara = array_keys($arrSementara);
                            foreach($keySementara as $keySem){

                                if($sheetsName['Kemasan'][$i] === $keySem){
                                    $data[$barandInd][$sheetsName['Kemasan'][$i]] = $arrSementara[$keySem];
                                    break;
                                }

                                $data[$barandInd][$sheetsName['Kemasan'][$i]] = '';
                            }
                        }
                    }



                }

            }

            $sheets[] = new PerSheetBC41Export($key, $sheetsName[$key], $data);
        }

        return $sheets;
    }
}

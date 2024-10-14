<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class TemplateBC23Export implements WithMultipleSheets
{
    use Exportable;

    private $inbound;

    public function __construct($inbound){
        $this->inbound = $inbound;
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
                'WAKTU STUFFING',
                'NOMOR POLISI',
                'CALL SIGN',
                'JUMLAH TANDA PENGAMAN',
                'KODE KANTOR MUAT',
                'KODE PEL TUJUAN',
                '',
                'TANGGAL STUFFING'
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
                'SERI IJIN',
                'ID EKSPORTIR',
                'NAMA EKSPORTIR',
                'ALAMAT EKSPORTIR',
                'KODE PERHITUNGAN',
                'SERI BARANG DOK ASAL',
                'RATE PREFERENCE'
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

        foreach($keys as $key){

            $data = [];
            
            if($key == 'Dokumen'){
                $seridoku = 1;

                foreach($this->inbound->inboundDocuments as $ind=>$inboundDocument){

                    if($inboundDocument->document_id != 104){
                   $data[$ind]['nomer_aju'] = $this->inbound->request_number ?? '';
                   $data[$ind]['seri_dokumen'] = $seridoku ?? '';
                   $data[$ind]['flag_url_dokumen'] = '';
                   $data[$ind]['kode_jenis_dokumen'] = $inboundDocument->document_id ?? '';
                   $data[$ind]['nomor_dokumen'] = $inboundDocument->details['nomor_dokumen'] ?? '';
                   $data[$ind]['tanggal_dokumen'] = $inboundDocument->details['date'] ?? '';
                   $data[$ind]['tipe_dokumen'] = $inboundDocument->masterDocument->name ?? '';
                   $data[$ind]['url_dokumen'] = '';
                   $seridoku++;

                }
                
            }
        }
            $jumlahbarang = $this->inbound->inboundDetails;
                $jumlahbar = 0;
                $jumlahkem = 0;
                foreach ($jumlahbarang as $barang) {
                    $jumlahbar += $barang->quantity;
                    $jumlahkem += $barang->package_details['jumlah'];
                }

            if($key == 'Header'){

                $kodenegarapemasok= DB::table('countries')->where('id','=', $this->inbound->inboundPemasokBarang->profile->country_id)->first();
                $nomorBC11 = DB::table('inbound_documents')->where('inbound_id','=',$this->inbound->id)->where('document_id','=',104)->first();
                if($nomorBC11 != null)
                $nomorBC11s = json_decode($nomorBC11->details);

                $transportid = $this->inbound->inboundTransportation->id;

                $unload = DB::table('inbound_transportation_ports')->where('inbound_transportation_id','=',$transportid)->where('type','=','bongkar')->first();
                $load = DB::table('inbound_transportation_ports')->where('inbound_transportation_id','=',$transportid)->where('type','=','muat')->first();
                $transit = DB::table('inbound_transportation_ports')->where('inbound_transportation_id','=',$transportid)->where('type','=','transit')->first();

                $unloadport = DB::table('ports')->where('id','=',$unload->port_id)->first();
                $loadport = DB::table('ports')->where('id','=',$load->port_id)->first();
                $transitport = DB::table('ports')->where('id','=',$transit->port_id)->first();


                $arrSementara = [
                    'NOMOR AJU' => $this->inbound->request_number ?? '',
                    'KPPBC' => $this->inbound->inboundKppbc->masterKppbc->code ?? '',
                    'PERUSAHAAN' => $this->inbound->inboundImportir->profile->name ?? '',
                    'PEMASOK' => $this->inbound->inboundPemasokBarang->profile->name ?? '',
                    'STATUS' => 1,
                    'KODE DOKUMEN PABEAN' => 23,
                    'NPPJK' => $this->inbound->inboundPpjk->profile->details['nomor_ppjk'] ?? '',
                    'ALAMAT PEMASOK' => $this->inbound->inboundPemasokBarang->profile->address ?? '',
                    'ALAMAT PEMILIK' => $this->inbound->inboundPemilikBarang->profile->address ?? '',
                    // 'ALAMAT PENGUSAHA' => $this->inbound->inboundImportir->profile->address ?? '',
                    'ALAMAT PPJK' => $this->inbound->inboundPpjk->profile->address ?? '',
                    'API PEMILIK' => $this->inbound->inboundPemilikBarang->profile->details['nomor_api'] ?? '',
                    'API PENGUSAHA' => $this->inbound->inboundImportir->profile->details['nomor_api'] ?? '',
                    'ASURANSI' => $this->inbound->details['asuransi'] ?? '',
                    'BIAYA TAMBAHAN' => $this->inbound->details['biaya_penambah'] ?? '',
                    'BRUTO' => $this->inbound->details['berat_kotor'] ?? '',
                    'CIF' => $this->inbound->details['nilai_cif'] ?? '',
                    'CIF RUPIAH' => $this->inbound->details['cif_rp'] ?? '',
                    'DISKON' => $this->inbound->details['biaya_pengurang'] ?? '',
                    'FOB' => $this->inbound->details['fob'] ?? '',
                    'FREIGHT' => $this->inbound->details['freight'] ?? '',
                    'ID PEMASOK' => $this->inbound->inboundPemasokBarang->id ?? '',
                    'ID PEMILIK' => $this->inbound->inboundPemilikBarang->id ?? '',
                    'ID PENGUSAHA' => $this->inbound->inboundImportir->id ?? '',
                    'ID PPJK' => $this->inbound->inboundPpjk->id ?? '',
                    'JUMLAH BARANG' => $jumlahbar ?? '',
                    'JUMLAH KEMASAN' => $jumlahkem ?? '',
                    'JUMLAH KONTAINER' => 1,
                    'KODE BENDERA' => $this->inbound->inboundTransportation->country_code ?? '',
                    'KODE CARA ANGKUT' => $this->inbound->inboundTransportation->transportation->id ?? '',
                    'KODE ID PEMASOK' => $this->inbound->inboundPemasokBarang->profile->id ?? '',
                    'KODE ID PEMILIK' => $this->inbound->inboundPemilikBarang->profile->id ?? '',
                    'KODE ID PENGUSAHA' => $this->inbound->inboundImportir->profile->id ?? '',
                    'KODE ID PPJK' => $this->inbound->inboundPpjk->profile->id ?? '',
                    'KODE JENIS API PEMILIK' => $this->inbound->inboundPemilikBarang->profile->details['tipe_api'] ?? '',
                    'KODE JENIS API PENGUSAHA' => $this->inbound->inboundImportir->profile->details['tipe_api'] ?? '',
                    'KODE JENIS TPB' => $this->inbound->inboundJenisTpb->masterJenisTpb->code ?? '',
                    'KODE KANTOR BONGKAR' => $this->inbound->inboundKppbcBongkar->masterKppbc->code ?? '',
                    'KODE NEGARA PEMASOK' => $kodenegarapemasok->code ?? '',
                    'KODE PEL BONGKAR' => $unloadport->code ?? '',
                    'KODE PEL MUAT' => $loadport->code ?? '',
                    'KODE PEL TRANSIT' =>  $transitport->code ?? '',
                    'KODE VALUTA' => $this->inbound->inboundValas->masterValas->code ?? '', 
                    'JABATAN TTD' => $this->inbound->details['pabean_jabatan'] ?? '',
                    'KOTA TTD' => $this->inbound->city->city ?? '',
                    'NAMA PEMILIK' => $this->inbound->inboundPemilikBarang->profile->name ?? '',
                    'NAMA PENGANGKUT' => $this->inbound->inboundTransportation->transportation->name ?? '',
                    'NAMA PPJK' => $this->inbound->inboundPpjk->profile->name ?? '',
                    'NAMA TTD' => $this->inbound->details['pabean_pemberitahu'] ?? '',
                    'NDPBM' => $this->inbound->details['ndpbm'] ?? '',
                    'NETTO' => $this->inbound->details['berat_bersih'] ?? '',
                    'NOMOR BC11' => $nomorBC11s->nomor_dokumen ?? '',
                    'NOMOR IJIN BPK PEMASOK' =>  $this->inbound->inboundPemasokBarang->profile->details['nomor_izin'] ?? '',
                    'NOMOR IJIN BPK PENGUSAHA' => $this->inbound->inboundImportir->profile->details['nomor_izin'] ?? '',
                    'NOMOR IJIN TPB' => $this->inbound->inboundTpb->profile->details['nomor_izin'] ?? '',
                    'NOMOR VOYV FLIGHT' => $this->inbound->inboundTransportation->vehicle_number ?? '',
                    'POS BC11' => $nomorBC11s->nomor_pos_dokumen ?? '',
                    'SUBPOS BC11' => $nomorBC11s->nomor_sub_pos_dokumen ?? '',
                    'SUB SUBPOS BC11' => $nomorBC11s->nomor_sub_sub_pos_dokumen ?? '',
                    'TANGGAL BC11' => $nomorBC11s->date ?? '',
                    'TANGGAL TTD' => $this->inbound->details['pabean_tanggal'] ?? '',
                    'TOTAL BEBAS' => $this->inbound->details['total_dibebaskan'] ?? '',
                    'TOTAL TANGGUH' => $this->inbound->details['total_ditangguhkan'] ?? '',
                    'TOTAL TIDAK DIPUNGUT' => $this->inbound->details['total_tidak_dipungut'] ?? '',
                    // 'WAKTU BONGKAR' => $this->inbound->inboundDetails[0]->volume ?? ''
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

            if($key == 'Barang'){

                foreach($this->inbound->inboundDetails as $barandInd=>$inboundDetail){

                    $arrSementara = [
                        'NOMOR AJU' => $this->inbound->request_number ?? '',
                        'SERI BARANG' => $barandInd+1 ?? '',
                        'ASURANSI' => $inboundDetail->details['asuransi'] ?? '',
                        'CIF' => $inboundDetail->details['nilai_cif'] ?? '',
                        'CIF RUPIAH' => $inboundDetail->details['cif_rp'] ?? '',
                        'DISKON' => $inboundDetail->details['biaya_pengurang'] ?? '',
                        'FOB' => $inboundDetail->details['fob'] ?? '',
                        'FREIGHT' => $inboundDetail->details['freight'] ?? '',
                        'HARGA SATUAN' => $inboundDetail->details['harga_satuan'] ?? '',
                        // 'HARGA PENYERAHAN' => "aaa",
                        'JUMLAH KEMASAN' => $barang->package_details['jumlah'] ?? '',
                        'JUMLAH BAHAN BAKU' => $jumlahbar ?? '',
                        'JUMLAH SATUAN' => $inboundDetail->quantity ?? '',
                        'KODE BARANG' => $inboundDetail->details['kode_barang'] ?? '',
                        'KODE FASILITAS' => $inboundDetail->details['fasilitas'] ?? '',
                        'KODE SATUAN' => $inboundDetail->package->code ?? '',
                        'MERK' => $inboundDetail->details['merk'] ?? '',
                        'NETTO' => $inboundDetail->nett_weight ?? '',
                        'SPESIFIKASI LAIN' => $inboundDetail->details['spesifikasi_lain'] ?? '',
                        'TIPE' => $inboundDetail->details['type'] ?? '',
                        'UKURAN' => $inboundDetail->details['ukuran'] ?? '',
                        'URAIAN' => $inboundDetail->details['uraian'] ?? '',
                        'VOLUME' => $inboundDetail->volume ?? '',
                        'RATE PREFERENCE' => $inboundDetail->ratePreference->name ?? ''
                    ];
    
                    for($i = 0 ; $i < count($sheetsName['Barang']) ; $i++){
    
                        $keySementara = array_keys($arrSementara);
                        foreach($keySementara as $keySem){
                            
                            if($sheetsName['Barang'][$i] === $keySem){
                                $data[$barandInd][$sheetsName['Barang'][$i]] = $arrSementara[$keySem];
                                break;
                            }
                            
                            $data[$barandInd][$sheetsName['Barang'][$i]] = '';
                        }
                    }

                }

            }

            if($key == 'BarangTarif'){
                $barangdetail = 0;
                $angka = 1;

                foreach($this->inbound->inboundDetails as $barandInd=>$inboundDetail){

                    // $arrayku = ['bm_ditangguhkan','bm_dibebaskan','bm_tidak_dipungut','ppn_ditangguhkan','ppn_dibebaskan','ppn_tidak_dipungut',
                    //             'ppnbm_ditangguhkan','ppnbm_dibebaskan','ppnbm_tidak_dipungut','pph_ditangguhkan','pph_dibebaskan','pph_tidak_dipungut',
                    //             'cukai_ditangguhkan','cukai_dibebaskan','cukai_tidak_dipungut'];


                    $arrayku = ['bm','ppn','ppnbm','pph'];

                    // $ukurandetails = sizeof($inboundDetail);

                    foreach($arrayku as $arrayku){
                            $KodeFasilitas = 0;
                            $jenistarif = 0;

                        if($inboundDetail->details[$arrayku] != 0){ 
                            
                            if($inboundDetail->details[$arrayku.'_tax_type'] == '1'){
                                $KodeFasilitas = 2;
                            }
                            if($inboundDetail->details[$arrayku.'_tax_type'] == '5'){
                                $KodeFasilitas = 4;
                            }
                            if($inboundDetail->details[$arrayku.'_tax_type'] == '6'){
                                $KodeFasilitas = 5;
                            }

                            if($arrayku == 'bm')
                            {
                                $jenistarif = 'BM';
                                $tarif = $inboundDetail->details['bm'];
                                $tarif_fasi = $inboundDetail->details['bm_tax_value'];
                            }
                            if($arrayku == 'ppn')
                            {
                                $jenistarif = 'PPN';
                                $tarif = $inboundDetail->details['ppn'];
                                $tarif_fasi = $inboundDetail->details['ppn_tax_value'];
                            }
                            if($arrayku == 'ppnbm')
                            {
                                $jenistarif = 'PPNBM';
                                $tarif = $inboundDetail->details['ppnbm'];
                                $tarif_fasi = $inboundDetail->details['ppnbm_tax_value'];
                            }
                            if($arrayku == 'pph')
                            {
                                $jenistarif = 'PPH';
                                $tarif = $inboundDetail->details['pph'];
                                $tarif_fasi = $inboundDetail->details['pph_tax_value'];
                            }
                            if($arrayku == 'cukai')
                            {
                                $jenistarif = 'CUKAI';
                                $tarif = $inboundDetail->details['cukai'];
                                $tarif_fasi = $inboundDetail->details['cukai_tax_value'];
                            } 

                            $arrSementara = [
                                'NOMOR AJU' => $this->inbound->request_number ?? '',
                                'SERI BARANG' => $angka ?? '',
                                'JENIS TARIF' => $jenistarif ?? '',
                                'JUMLAH SATUAN' => '',
                                'KODE FASILITAS' => $KodeFasilitas ?? '',
                                'TARIF' =>  $tarif ?? '',
                                'TARIF FASILITAS' => $tarif_fasi ?? '',
                            ];
                            
                       
                            for($i = 0 ; $i < count($sheetsName['BarangTarif']) ; $i++){
            
                                $keySementara = array_keys($arrSementara);
                                foreach($keySementara as $keySem){
                                    
                                    if($sheetsName['BarangTarif'][$i] === $keySem){
                                        $data[$barangdetail][$sheetsName['BarangTarif'][$i]] = $arrSementara[$keySem];
                                        break;
                                    }
                                    
                                    $data[$barangdetail][$sheetsName['BarangTarif'][$i]] = '';
                                    
                                }
                            } 
                        }
                    $barangdetail++;
                    }
                    $angka++;
                }

            }

            if($key == 'BarangDokumen'){
                foreach($this->inbound->inboundDocumentsExcel as $barandInd=>$barangdoku){

                    if($barangdoku->document_id != 104){
                        $arrSementara = [
                        'NOMOR AJU' => $this->inbound->request_number ?? '',
                        'SERI BARANG' => $barangdoku->seri_barang ?? '',
                        'SERI DOKUMEN' => $barangdoku->seri_document ?? ''
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
                
            }

            if($key == 'Kemasan'){

                
                foreach($this->inbound->inboundDetails as $barandInd=>$inboundDetail){

                    $arrSementara = [
                        'NOMOR AJU' => $this->inbound->request_number ?? '',
                        'JUMLAH KEMASAN' => $inboundDetail->package_details['jumlah'] ?? '',
                        'KODE JENIS KEMASAN' => $inboundDetail->package->code ?? '',
                        'MEREK KEMASAN' => $inboundDetail->package_details['merk'] ?? ''
                        
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

            if($key == 'Kontainer'){
                $arrSementara = [
                    'NOMOR AJU' => $this->inbound->request_number ?? '',
                    'KODE TIPE KONTAINER' => $this->inbound->details['type_peti_kemas_id'] ?? '',
                    'KODE UKURAN KONTAINER' => $this->inbound->details['ukuran_peti_kemas_id'] ?? '',
                    'NOMOR KONTAINER' => $this->inbound->details['nomor_peti_kemas'] ?? ''
                    
                ];

                for($i = 0 ; $i < count($sheetsName['Kontainer']) ; $i++){

                    $keySementara = array_keys($arrSementara);
                    foreach($keySementara as $keySem){
                        
                        if($sheetsName['Kontainer'][$i] === $keySem){
                            $data[  0][$sheetsName['Kontainer'][$i]] = $arrSementara[$keySem];
                            break;
                        }
                        
                        $data[0][$sheetsName['Kontainer'][$i]] = '';
                    }
                }
            }

            $sheets[] = new PerSheetBC25Export($key, $sheetsName[$key], $data);
        }

        return $sheets;
    }   
}

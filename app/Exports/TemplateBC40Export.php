<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class TemplateBC40Export implements WithMultipleSheets
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
                'KODE JENIS TANDA PENGAMAN',
                'KODE KANTOR MUAT',
                'KODE PEL TUJUAN',
                '',
                'TANGGAL STUFFING',
                'TANGGAL MUAT',
                'KODE GUDANG ASAL',
                'KODE GUDANG TUJUAN'
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
                'KODE STATUS',
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
                'SERI BARANG DOK ASAL'
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
                $angka = 1;
                foreach($this->inbound->inboundDocuments as $ind=>$inboundDocument){

                   $data[$ind]['nomer_aju'] = $this->inbound->request_number ?? '';
                   $data[$ind]['seri_dokumen'] = $angka ?? '';
                   $data[$ind]['flag_url_dokumen'] = '';
                   $data[$ind]['kode_jenis_dokumen'] = $inboundDocument->document_id ?? '';
                   $data[$ind]['nomor_dokumen'] = $inboundDocument->details['nomor_dokumen'] ?? '';
                   $data[$ind]['tanggal_dokumen'] = $inboundDocument->details['date'] ?? '';
                   $data[$ind]['tipe_dokumen'] = $inboundDocument->masterDocument->name ?? '';
                   $data[$ind]['url_dokumen'] = '';
                   $angka += 1;

                }
                
            }

            if($key == 'Header'){

                
        $jumlahbarang = $this->inbound->inboundDetails;
        $jumlahbar = 0;
        $jumlahkem = 0;
        foreach ($jumlahbarang as $barang) {
            $jumlahbar += $barang->quantity;
            $jumlahkem += $barang->package_details['jumlah'];
        }
        $kodenegarapengirim = DB::table('countries')->where('id','=', $this->inbound->inboundPengirimBarang->profile->country_id)->first();

                $arrSementara = [
                    'NOMOR AJU' => $this->inbound->request_number ?? '',
                    'KPPBC' => $this->inbound->inboundKppbc->masterKppbc->code ?? '',
                    'PERUSAHAAN' => $this->inbound->inboundTpb->profile->name ?? '',
                    'STATUS' => 1,
                    'KODE DOKUMEN PABEAN' => 40,
                    'ALAMAT PENGIRIM' => $this->inbound->inboundPengirimBarang->profile->address ?? '',
                    'ALAMAT PENGUSAHA' => $this->inbound->inboundTpb->profile->address ?? '',
                    'BRUTO' => $this->inbound->details['berat_kotor'] ?? '',
                    'HARGA PENYERAHAN' => $this->inbound->details['harga_penyerahan'] ?? '',
                    'ID PENGIRIM' => $this->inbound->inboundPengirimBarang->profile->details['nomor_identitas'] ?? '',
                    'ID PENGUSAHA' => $this->inbound->inboundTpb->profile->details['nomor_identitas'] ?? '',
                    'JABATAN TTD' => $this->inbound->details['pabean_jabatan'] ?? '',
                    'JUMLAH BARANG' => $jumlahbar ?? '',
                    'JUMLAH KEMASAN' => $jumlahkem ?? '', 
                    'KODE ID PENGIRIM' => $this->inbound->inboundPengirimBarang->profile->id ?? '', // tanya harus diisi apa, skarang id profile
                    'KODE ID PENGUSAHA' => $this->inbound->inboundTpb->profile->id ?? '', // tanya harus diisi apa, skarang id profile
                    'KODE JENIS API PENGUSAHA' => $this->inbound->inboundTpb->profile->details['tipe_api'] ?? '',
                    'KOTA TTD' => $this->inbound->city->city ?? '',
                    'KODE JENIS TPB' => $this->inbound->inboundJenisTpb->masterJenisTpb->code ?? '',
                    'KODE NEGARA PENGIRIM' => $kodenegarapengirim->code ?? '',
                    'KODE TUJUAN PENGIRIMAN' => $this->inbound->inboundTujuanPengiriman->tujuan_pengiriman_id ?? '',
                    'NAMA PENGANGKUT' => $this->inbound->inboundTransportation->transportation->name ?? '',
                    'NAMA PENGIRIM' => $this->inbound->inboundPengirimBarang->profile->name ?? '',
                    'NAMA TTD' => $this->inbound->details['pabean_pemberitahu'] ?? '',
                    'NETTO' => $this->inbound->details['berat_bersih'] ?? '',
                    'NOMOR IJIN TPB' => $this->inbound->inboundTpb->profile->details['nomor_izin'] ?? '',
                    'TANGGAL TTD' => $this->inbound->details['pabean_tanggal'] ?? '',
                    'WAKTU BONGKAR' => $this->inbound->details['volume'] ?? '', //Volume
                    'CALL SIGN' => $this->inbound->inboundTransportation->vehicle_number ?? '' // Nomor Polisi
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
                        'SERI BARANG' => $barandInd+1,
                        'HARGA PENYERAHAN' => $inboundDetail->details['harga_penyerahan'] ?? '',
                        'HARGA SATUAN' => $inboundDetail->details['harga_barang'] ?? '',
                        'JENIS KENDARAAN' => $this->inbound->inboundTransportation->transportation->name ?? '',
                        'JUMLAH BAHAN BAKU' => $inboundDetail->quantity ?? '',
                        'JUMLAH KEMASAN' => $inboundDetail->package_details['jumlah'] ?? '',
                        'JUMLAH SATUAN' => $inboundDetail->quantity ?? '',
                        'KATEGORI BARANG' => 1,
                        'KODE BARANG' => $inboundDetail->details['kode_barang'] ?? '',
                        'KODE KEMASAN' => $inboundDetail->package->code ?? '',
                        'KODE SATUAN' => $inboundDetail->good->uom->name ?? '',
                        'MERK' => $inboundDetail->details['merk'] ?? '',
                        'NETTO' => $inboundDetail->nett_weight ?? '',
                        'SPESIFIKASI LAIN' => $inboundDetail->details['spesifikasi_lain'] ?? '',
                        'UKURAN' => $inboundDetail->details['ukuran'] ?? '',
                        'TIPE' => $inboundDetail->details['type'] ?? '',
                        'URAIAN' => $inboundDetail->details['uraian'] ?? '',
                        'VOLUME' => $inboundDetail->volume ?? ''
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

            if($key == 'BarangDokumen'){
                foreach($this->inbound->inboundDocumentsExcel as $barandInd=>$barangdoku){
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

            $sheets[] = new PerSheetBC40Export($key, $sheetsName[$key], $data);
        }

        return $sheets;
    }   
}

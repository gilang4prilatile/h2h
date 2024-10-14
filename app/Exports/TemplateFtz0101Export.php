<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class TemplateFtz0101Export implements WithMultipleSheets
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
            'HEADER' => [
                'NOMOR AJU',
                'KODE DOKUMEN',
                'KODE KANTOR',
                'KODE KANTOR BONGKAR',
                'KODE KANTOR PERIKSA',
                'KODE KANTOR TUJUAN',
                'KODE KANTOR EKSPOR',
                'KODE JENIS IMPOR',
                'KODE JENIS EKSPOR',
                'KODE JENIS TPB',
                'KODE JENIS PLB',
                'KODE JENIS PROSEDUR',
                'KODE TUJUAN PEMASUKAN',
                'KODE TUJUAN PENGIRIMAN',
                'KODE TUJUAN TPB',
                'KODE CARA DAGANG',
                'KODE CARA BAYAR',
                'KODE CARA BAYAR LAINNYA',
                'KODE GUDANG ASAL',
                'KODE GUDANG TUJUAN',
                'KODE JENIS KIRIM',
                'KODE JENIS PENGIRIMAN',
                'KODE KATEGORI EKSPOR',
                'KODE KATEGORI MASUK FTZ',
                'KODE KATEGORI KELUAR FTZ',
                'KODE KATEGORI BARANG FTZ',
                'KODE LOKASI',
                'KODE LOKASI BAYAR',
                'LOKASI ASAL',
                'LOKASI TUJUAN',
                'KODE DAERAH ASAL',
                'KODE GUDANG ASAL',
                'KODE GUDANG TUJUAN',
                'KODE NEGARA TUJUAN',
                'KODE TUTUP PU',
                'NOMOR BC11',
                'TANGGAL BC11',
                'NOMOR POS',
                'NOMOR SUB POS',
                'KODE PELABUHAN BONGKAR',
                'KODE PELABUHAN MUAT',
                'KODE PELABUHAN MUAT AKHIR',
                'KODE PELABUHAN TRANSIT',
                'KODE PELABUHAN TUJUAN',
                'KODE PELABUHAN EKSPOR',
                'KODE TPS',
                'TANGGAL BERANGKAT',
                'TANGGAL EKSPOR',
                'TANGGAL MASUK',
                'TANGGAL MUAT',
                'TANGGAL TIBA',
                'TANGGAL PERIKSA',
                'TEMPAT STUFFING',
                'TANGGAL STUFFING',
                'KODE TANDA PENGAMAN',
                'JUMLAH TANDA PENGAMAN',
                'FLAG CURAH',
                'FLAG SDA',
                'FLAG VD',
                'FLAG AP BK',
                'FLAG MIGAS',
                'KODE ASURANSI',
                'ASURANSI',
                'NILAI BARANG',
                'NILAI INCOTERM',
                'NILAI MAKLON',
                'ASURANSI',
                'FREIGHT',
                'FOB',
                'BIAYA TAMBAHAN',
                'BIAYA PENGURANG',
                'VD',
                'CIF',
                'HARGA_PENYERAHAN',
                'NDPBM',
                'TOTAL DANA SAWIT',
                'DASAR PENGENAAN PAJAK',
                'NILAI JASA',
                'UANG MUKA',
                'BRUTO',
                'NETTO',
                'VOLUME',
                'KOTA PERNYATAAN',
                'TANGGAL PERNYATAAN',
                'NAMA PERNYATAAN',
                'JABATAN PERNYATAAN',
                'KODE VALUTA',
                'KODE INCOTERM',
                'KODE JASA KENA PAJAK',
                'NOMOR BUKTI BAYAR',
                'TANGGAL BUKTI BAYAR',
                'KODE JENIS NILAI',
                'KODE KANTOR MUAT',
                'NOMOR DAFTAR',
                'TANGGAL DAFTAR',
                'KODE ASAL BARANG FTZ',
                'KODE TUJUAN PENGELUARAN',
                'PPN PAJAK',
                'PPNBM PAJAK',
                'TARIF PPN PAJAK',
                'TARIF PPNBM PAJAK',
                'BARANG TIDAK BERWUJUD',
                'KODE JENIS PENGELUARAN'
            ],
            'ENTITAS' => [
                'NOMOR AJU',
                'SERI',
                'KODE ENTITAS',
                'KODE JENIS IDENTITAS',
                'NOMOR IDENTITAS',
                'NAMA ENTITAS',
                'ALAMAT ENTITAS',
                'NIB ENTITAS',
                'KODE JENIS API',
                'KODE STATUS',
                'NOMOR IJIN ENTITAS',
                'TANGGAL IJIN ENTITAS',
                'KODE NEGARA',
                'NIPER ENTITAS'
            ],
            'DOKUMEN' =>
            [
                'NOMOR AJU',
                'SERI',
                'KODE DOKUMEN',
                'NOMOR DOKUMEN',
                'TANGGAL DOKUMEN',
                'KODE FASILITAS',
                'KODE IJIN'
            ],
            'PENGANGKUT' =>
            [
                'NOMOR AJU',
                'SERI',
                'KODE CARA ANGKUT',
                'NAMA PENGANGKUT',
                'NOMOR PENGANGKUT',
                'KODE BENDERA',
                'CALL SIGN',
                'FLAG ANGKUT PLB'
            ],
            'KEMASAN' =>
            [
                'NOMOR AJU',
                'SERI',
                'KODE KEMASAN',
                'JUMLAH KEMASAN',
                'MEREK'
            ],
            'KONTAINER'=>
            [
                'NOMOR AJU',
                'SERI',
                'NOMOR KONTINER',
                'KODE UKURAN KONTAINER',
                'KODE JENIS KONTAINER',
                'KODE TIPE KONTAINER'
            ],
            'BARANG'=>
            [
                'NOMOR AJU',
                'SERI BARANG',
                'HS',
                'KODE BARANG',
                'URAIAN',
                'MEREK',
                'TIPE',
                'UKURAN',
                'SPESIFIKASI LAIN',
                'KODE SATUAN',
                'JUMLAH SATUAN',
                'KODE KEMASAN',
                'JUMLAH KEMASAN',
                'KODE DOKUMEN ASAL',
                'KODE KANTOR ASAL',
                'NOMOR DAFTAR ASAL',
                'TANGGAL DAFTAR ASAL',
                'NOMOR AJU ASAL',
                'SERI BARANG ASAL',
                'NETTO',
                'BRUTO',
                'VOLUME',
                'SALDO AWAL',
                'SALDO AKHIR',
                'JUMLAH REALISASI',
                'CIF',
                'CIF RUPIAH',
                'NDPBM',
                'FOB',
                'ASURANSI',
                'FREIGHT',
                'NILAI TAMBAH',
                'DISKON',
                'HARGA PENYERAHAN',
                'HARGA PEROLEHAN',
                'HARGA SATUAN',
                'HARGA EKSPOR',
                'HARGA PATOKAN',
                'NILAI BARANG',
                'NILAI JASA',
                'NILAI DANA SAWIT',
                'NILAI DEVISA',
                'PERSENTASE IMPOR',
                'KODE ASAL BARANG',
                'KODE DAERAH ASAL',
                'KODE GUNA BARANG',
                'KODE JENIS NILAI',
                'JATUH TEMPO ROYALTI',
                'KODE KATEGORI BARANG',
                'KODE KONDISI BARANG',
                'KODE NEGARA ASAL',
                'KODE PERHITUNGAN',
                'PERNYATAAN LARTAS',
                'FLAG 4 TAHUN',
                'SERI IZIN',
                'TAHUN PEMBUATAN',
                'KAPASITAS SILINDER',
                'KODE BKC',
                'KODE KOMODITI BKC',
                'KODE SUB KOMODITI BKC',
                'FLAG TIS',
                'ISI PER KEMASAN',
                'JUMLAH DILEKATKAN',
                'JUMLAH PITA CUKAI',
                'HJE CUKAI',
                'TARIF CUKAI'
            ],
            'BARANGTARIF' => [
                'NOMOR AJU',
                'SERI BARANG',
                'KODE PUNGUTAN',
                'KODE TARIF',
                'TARIF',
                'KODE FASILITAS',
                'TARIF FASILITAS',
                'NILAI BAYAR',
                'NILAI FASILITAS',
                'NILAI SUDAH DILUNASI',
                'KODE SATUAN',
                'JUMLAH SATUAN',
                'FLAG BMT SEMENTARA',
                'KODE KOMODITI CUKAI',
                'KODE SUB KOMODITI CUKAI',
                'FLAG TIS',
                'FLAG PELEKATAN',
                'KODE KEMASAN',
                'JUMLAH KEMASAN'
            ],
            'BARANGDOKUMEN' => [
                'NOMOR AJU',
                'SERI BARANG',
                'SERI DOKUMEN',
                'SERI IZIN'
            ],
            'BARANGENTITAS' => [
                'NOMOR AJU',
                'SERI BARANG',
                'SERI DOKUMEN'
            ],
            'BARANGSPEKKHUSUS' => [
                'NOMOR AJU',
                'SERI BARANG',
                'KODE',
                'URAIAN'
            ],
            'BARANGVD' => [
                'NOMOR AJU',
                'SERI BARANG',
                'KODE VD',
                'NILAI BARANG',
                'BIAYA TAMBAHAN',
                'BIAYA PENGURANG',
                'JATUH TEMPO'
            ],
            'BAHANBAKU' => [
                'NOMOR AJU',
                'SERI BARANG',
                'SERI BAHAN BAKU',
                'KODE ASAL BAHAN BAKU',
                'HS',
                'KODE BARANG',
                'URAIAN',
                'MEREK',
                'TIPE',
                'UKURAN',
                'SPESIFIKASI LAIN',
                'KODE SATUAN',
                'JUMLAH SATUAN',
                'KODE KEMASAN',
                'JUMLAH KEMASAN',
                'KODE DOKUMEN ASAL',
                'KODE KANTOR ASAL',
                'NOMOR DAFTAR ASAL',
                'TANGGAL DAFTAR ASAL',
                'NOMOR AJU ASAL',
                'SERI BARANG ASAL',
                'NETTO',
                'BRUTO',
                'VOLUME',
                'CIF',
                'CIF RUPIAH',
                'NDPBM',
                'HARGA PENYERAHAN',
                'HARGA PEROLEHAN',
                'NILAI JASA',
                'SERI IZIN',
                'VALUTA',
                'KODE BKC',
                'KODE KOMODITI BKC',
                'KODE SUB KOMODITI BKC',
                'FLAG TIS',
                'ISI PER KEMASAN',
                'JUMLAH DILEKATKAN',
                'JUMLAH PITA CUKAI',
                'HJE CUKAI',
                'TARIF CUKAI'
            ],
            'BAHANBAKUTARIF' => [
                'NOMOR AJU',
                'SERI BARANG',
                'SERI BAHAN BAKU',
                'KODE ASAL BAHAN BAKU',
                'KODE PUNGUTAN',
                'KODE TARIF',
                'TARIF',
                'KODE FASILITAS',
                'TARIF FASILITAS',
                'NILAI BAYAR',
                'NILAI FASILITAS',
                'NILAI SUDAH DILUNASI',
                'KODE SATUAN',
                'JUMLAH SATUAN',
                'FLAG BMT SEMENTARA',
                'KODE KOMODITI CUKAI',
                'KODE SUB KOMODITI CUKAI',
                'FLAG TIS',
                'FLAG PELEKATAN',
                'KODE KEMASAN',
                'KODE SUB KOMODITI CUKAI',
                'FLAG TIS',
                'FLAG PELEKATAN',
                'KODE KEMASAN',
                'JUMLAH KEMASAN'
            ],
            'BAHANBAKUDOKUMEN' => [
                'NOMOR AJU',
                'SERI BARANG',
                'SERI BAHAN BAKU',
                'KODE_ASAL_BAHAN_BAKU',
                'SERI DOKUMEN',
                'SERI IZIN'
            ],
            'PUNGUTAN' => [
                'NOMOR AJU',
                'KODE FASILITAS TARIF',
                'KODE JENIS PUNGUTAN',
                'NILAI PUNGUTAN',
                'NPWP BILLING'
            ],
            'JAMINAN' => [
                'NOMOR AJU',
                'KODE KANTOR',
                'KODE JAMINAN',
                'NOMOR JAMINAN',
                'TANGGAL JAMINAN',
                'NILAI JAMINAN',
                'PENJAMIN',
                'TANGGAL JATUH TEMPO',
                'NOMOR BPJ',
                'TANGGAL BPJ'
            ],
            'BANKDEVISA' => [
                'NOMOR AJU',
                'SERI',
                'KODE',
                'NAMA'
            ],
            'VERSI' => [
                'VERSI'
            ]
        ];


        $sheets = [];
        $data = [];
        $keys = array_keys($sheetsName);
        $jumlahbarang = $this->inbound->inboundDetails;
        $jumlahbar = 0;
        $jumlahkem = 0;
        foreach ($jumlahbarang as $barang) {
            $jumlahbar += $barang->quantity;
            $jumlahkem += $barang->package_details['jumlah'];
        }

        foreach($keys as $key){

            $data = [];
 
            if($key == 'HEADER'){
                
                $nomorBC11 = DB::table('inbound_documents')->where('inbound_id','=',$this->inbound->id)->where('document_id','=',104)->first();
                if($nomorBC11 != null)
                $nomorBC11s = json_decode($nomorBC11->details);

                $transportid = $this->inbound->inboundTransportation->pluck('id');
                
                $unload     = DB::table('inbound_transportation_ports')->where('inbound_transportation_id','=',$transportid)->where('type','=','bongkar')->first();
                $load       = DB::table('inbound_transportation_ports')->where('inbound_transportation_id','=',$transportid)->where('type','=','muat')->first();
                $transit    = DB::table('inbound_transportation_ports')->where('inbound_transportation_id','=',$transportid)->where('type','=','transit')->first();
                $tujuan     = DB::table('inbound_transportation_ports')->where('inbound_transportation_id','=',$transportid)->where('type','=','tujuan')->first();

                $unloadport     = DB::table('ports')->where('id','=',$unload->port_id)->first();
                $loadport       = DB::table('ports')->where('id','=',$load->port_id)->first();
                $transitport    = DB::table('ports')->where('id','=',$transit->port_id)->first();
                $tujuanport    = DB::table('ports')->where('id','=',$tujuan->port_id)->first();

                $arrSementara = [
                    'NOMOR AJU'                     => $this->inbound->request_number ?? '',
                    'KODE DOKUMEN'                  => 20,
                    'KODE KANTOR'                   => $this->inbound->inboundKppbc->masterKppbc->code ?? '',
                    'KODE KANTOR BONGKAR' => ' ',
                    'KODE KANTOR PERIKSA' => ' ',
                    'KODE KANTOR TUJUAN' => ' ',
                    'KODE KANTOR EKSPOR' => ' ',
                    'KODE JENIS IMPOR'              => $this->inbound->import_type_id ?? '',
                    'KODE JENIS EKSPOR' => ' ',
                    'KODE JENIS TPB' => ' ',
                    'KODE JENIS PLB' => ' ',
                    'KODE JENIS PROSEDUR' => 1,
                    'KODE TUJUAN PEMASUKAN' => ' ',
                    'KODE TUJUAN PENGIRIMAN' => ' ',
                    'KODE TUJUAN TPB' => ' ',
                    'KODE CARA DAGANG' => ' ',
                    'KODE CARA BAYAR'                => $this->inbound->payment_type_id ?? '',
                    'KODE CARA BAYAR LAINNYA'        => '',
                    'KODE GUDANG ASAL' => ' ',
                    'KODE GUDANG TUJUAN' => ' ',
                    'KODE JENIS KIRIM' => ' ',
                    'KODE JENIS PENGIRIMAN' => ' ',
                    'KODE KATEGORI EKSPOR' => ' ',
                    'KODE KATEGORI MASUK FTZ' => ' ',
                    'KODE KATEGORI KELUAR FTZ' => ' ',
                    'KODE KATEGORI BARANG FTZ' => ' ',
                    'KODE LOKASI' => ' ',
                    'KODE LOKASI BAYAR' => ' ',
                    'LOKASI ASAL' => ' ',
                    'LOKASI TUJUAN' => ' ',
                    'KODE DAERAH ASAL' => ' ',
                    'KODE GUDANG ASAL' => ' ',
                    'KODE GUDANG TUJUAN' => ' ',
                    'KODE NEGARA TUJUAN' => ' ',
                    'KODE TUTUP PU' => ' ',
                    'NOMOR BC11'                    => $nomorBC11s->nomor_dokumen ?? '',
                    'TANGGAL BC11'                  => $nomorBC11s->date ?? '',
                    'NOMOR POS'                     => $nomorBC11s->nomor_pos_dokumen ?? '',
                    'NOMOR SUB POS'                 => $nomorBC11s->nomor_sub_sub_pos_dokumen ?? '',                    
                    'KODE PELABUHAN BONGKAR'        => $unloadport->code ?? '',
                    'KODE PELABUHAN MUAT'           => $loadport->code ?? '',
                    'KODE PELABUHAN MUAT AKHIR'     => ' ',
                    'KODE PELABUHAN TRANSIT'        => $transitport->code ?? '',
                    'KODE PELABUHAN TUJUAN'         => $tujuanport->code ?? '',
                    'KODE PELABUHAN EKSPOR' => ' ',
                    'KODE TPS' => ' ',
                    'TANGGAL BERANGKAT' => ' ',
                    'TANGGAL EKSPOR' => ' ',
                    'TANGGAL MASUK' => ' ',
                    'TANGGAL MUAT' => ' ',
                    'TANGGAL TIBA' => ' ',
                    'TANGGAL PERIKSA' => ' ',
                    'TEMPAT STUFFING' => ' ',
                    'TANGGAL STUFFING' => ' ',
                    'KODE TANDA PENGAMAN' => ' ',
                    'JUMLAH TANDA PENGAMAN' => ' ',
                    'FLAG CURAH' => ' ',
                    'FLAG SDA' => ' ',
                    'FLAG VD' => ' ',
                    'FLAG AP BK' => ' ',
                    'FLAG MIGAS' => ' ',
                    'KODE ASURANSI' => ' ',
                    'ASURANSI' => ' ',
                    'NILAI BARANG' => ' ',
                    'NILAI INCOTERM' => ' ',
                    'NILAI MAKLON' => ' ',
                    'ASURANSI' => ' ',
                    'FREIGHT' => ' ',
                    'FOB' => ' ',
                    'BIAYA TAMBAHAN' => ' ',
                    'BIAYA PENGURANG' => ' ',
                    'VD' => ' ',
                    'CIF' => ' ',
                    'HARGA_PENYERAHAN' => ' ',
                    'NDPBM' => ' ',
                    'TOTAL DANA SAWIT' => ' ',
                    'DASAR PENGENAAN PAJAK' => ' ',
                    'NILAI JASA' => ' ',
                    'UANG MUKA' => ' ',
                    'BRUTO' => ' ',
                    'NETTO' => ' ',
                    'VOLUME' => ' ',
                    'KOTA PERNYATAAN'           => $this->inbound->city->city ?? '',
                    'TANGGAL PERNYATAAN'        => $this->inbound->details['pabean_tanggal'] ?? '',
                    'NAMA PERNYATAAN'           => $this->inbound->details['pabean_pemberitahu'] ?? '',
                    'JABATAN PERNYATAAN'        => $this->inbound->details['pabean_jabatan'] ?? '',
                    'KODE VALUTA' => ' ',
                    'KODE INCOTERM' => ' ',
                    'KODE JASA KENA PAJAK' => ' ',
                    'NOMOR BUKTI BAYAR' => ' ',
                    'TANGGAL BUKTI BAYAR' => ' ',
                    'KODE JENIS NILAI' => ' ',
                    'KODE KANTOR MUAT' => ' ',
                    'NOMOR DAFTAR' => ' ',
                    'TANGGAL DAFTAR' => ' ',
                    'KODE ASAL BARANG FTZ' => ' ',
                    'KODE TUJUAN PENGELUARAN' => ' ',
                    'PPN PAJAK' => ' ',
                    'PPNBM PAJAK' => ' ',
                    'TARIF PPN PAJAK' => ' ',
                    'TARIF PPNBM PAJAK' => ' ',
                    'BARANG TIDAK BERWUJUD' => ' ',
                    'KODE JENIS PENGELUARAN' => ' '
                ];

                for($i = 0 ; $i < count($sheetsName['HEADER']) ; $i++){

                    $keySementara = array_keys($arrSementara);
                    foreach($keySementara as $keySem){
                        
                        if($sheetsName['HEADER'][$i] === $keySem){
                            $data[0][$sheetsName['HEADER'][$i]] = $arrSementara[$keySem];
                            break;
                        }
                        
                        $data[0][$sheetsName['HEADER'][$i]] = '';
                    }
                }

            }

            if($key == 'ENTITAS'){
                $arrSementara = [
                    'NOMOR AJU' => ' ',
                    'SERI' => ' ',
                    'KODE ENTITAS' => ' ',
                    'KODE JENIS IDENTITAS' => ' ',
                    'NOMOR IDENTITAS' => ' ',
                    'NAMA ENTITAS' => ' ',
                    'ALAMAT ENTITAS' => ' ',
                    'NIB ENTITAS' => ' ',
                    'KODE JENIS API' => ' ',
                    'KODE STATUS' => ' ',
                    'NOMOR IJIN ENTITAS' => ' ',
                    'TANGGAL IJIN ENTITAS' => ' ',
                    'KODE NEGARA' => ' ',
                    'NIPER ENTITAS' => ' '
                ];
 
            }

            if($key == 'DOKUMEN'){
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

            if($key == 'PENGANGKUT'){
                $arrSementara = [
                    'NOMOR AJU' => ' ',
                    'SERI' => ' ',
                    'KODE CARA ANGKUT' => ' ',
                    'NAMA PENGANGKUT' => ' ',
                    'NOMOR PENGANGKUT' => ' ',
                    'KODE BENDERA' => ' ',
                    'CALL SIGN' => ' ',
                    'FLAG ANGKUT PLB' => ' '
                ];
 
            }

            if($key == 'KEMASAN'){

                foreach($this->inbound->inboundDetails as $barandInd=>$inboundDetail){

                    $arrSementara = [
                        'NOMOR AJU' => $this->inbound->request_number ?? '',
                        'JUMLAH KEMASAN' => $inboundDetail->package_details['jumlah'] ?? '',
                        'KODE JENIS KEMASAN' => $inboundDetail->package->code ?? '',
                        'MEREK KEMASAN' => $inboundDetail->package_details['merk'] ?? ''
                    ];

                    for($i = 0 ; $i < count($sheetsName['KEMASAN']) ; $i++){

                        $keySementara = array_keys($arrSementara);
                        foreach($keySementara as $keySem){
                            
                            if($sheetsName['KEMASAN'][$i] === $keySem){
                                $data[$barandInd][$sheetsName['KEMASAN'][$i]] = $arrSementara[$keySem];
                                break;
                            }
                            
                            $data[$barandInd][$sheetsName['KEMASAN'][$i]] = '';
                        }
                    }

                }

            }

            if($key == 'KONTAINER'){
                $arrSementara = [
                    'NOMOR AJU' => $this->inbound->request_number ?? '',
                    'KODE TIPE KONTAINER' => $this->inbound->details['type_peti_kemas_id'] ?? '',
                    'KODE UKURAN KONTAINER' => $this->inbound->details['ukuran_peti_kemas_id'] ?? '',
                    'NOMOR KONTAINER' => $this->inbound->details['nomor_peti_kemas'] ?? ''
                ];

                for($i = 0 ; $i < count($sheetsName['KONTAINER']) ; $i++){

                    $keySementara = array_keys($arrSementara);
                    foreach($keySementara as $keySem){
                        
                        if($sheetsName['KONTAINER'][$i] === $keySem){
                            $data[  0][$sheetsName['KONTAINER'][$i]] = $arrSementara[$keySem];
                            break;
                        }
                        
                        $data[0][$sheetsName['KONTAINER'][$i]] = '';
                    }
                }
            }

            if($key == 'BARANG'){

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

                    for($i = 0 ; $i < count($sheetsName['BARANG']) ; $i++){

                        $keySementara = array_keys($arrSementara);
                        foreach($keySementara as $keySem){
                            
                            if($sheetsName['BARANG'][$i] === $keySem){
                                $data[$barandInd][$sheetsName['BARANG'][$i]] = $arrSementara[$keySem];
                                break;
                            }
                            
                            $data[$barandInd][$sheetsName['BARANG'][$i]] = '';
                        }
                    }

                }

            }

            if($key == 'BARANGTARIF'){
                $barangdetail = 0;
                $angka = 1;

                foreach($this->inbound->inboundDetails as $barandInd=>$inboundDetail){
 
                    $arrayku = ['bm','ppn','ppnbm','pph'];
                    
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
                           
                            for($i = 0 ; $i < count($sheetsName['BARANGTARIF']) ; $i++){
            
                                $keySementara = array_keys($arrSementara);
                                foreach($keySementara as $keySem){
                                    
                                    if($sheetsName['BARANGTARIF'][$i] === $keySem){
                                        $data[$barangdetail][$sheetsName['BARANGTARIF'][$i]] = $arrSementara[$keySem];
                                        break;
                                    }
                                    
                                    $data[$barangdetail][$sheetsName['BARANGTARIF'][$i]] = '';
                                    
                                }
                            } 
                        }
                    $barangdetail++;
                    }
                    $angka++;
                }

            }
            
           
            if($key == 'BARANGDOKUMEN'){
                foreach($this->inbound->inboundDocumentsExcel as $barandInd=>$barangdoku){

                    if($barangdoku->document_id != 104){
                        $arrSementara = [
                        'NOMOR AJU' => $this->inbound->request_number ?? '',
                        'SERI BARANG' => $barangdoku->seri_barang ?? '',
                        'SERI DOKUMEN' => $barangdoku->seri_document ?? ''
                        ];

                        for($i = 0 ; $i < count($sheetsName['BARANGDOKUMEN']) ; $i++){

                            $keySementara = array_keys($arrSementara);
                            foreach($keySementara as $keySem){
                                
                                if($sheetsName['BARANGDOKUMEN'][$i] === $keySem){
                                    $data[$barandInd][$sheetsName['BARANGDOKUMEN'][$i]] = $arrSementara[$keySem];
                                    break;
                                }
                                
                                $data[$barandInd][$sheetsName['BARANGDOKUMEN'][$i]] = '';
                            }
                        }
                    }

                }
                
            }
            
            if($key == 'BARANGENTITAS'){
                $arrSementara = [
                    'NOMOR AJU' => ' ',
                    'SERI BARANG' => ' ',
                    'SERI DOKUMEN'  => ' '
                ];
 
            }

            if($key == 'BARANGENTITAS'){
                $arrSementara = [
                    'NOMOR AJU' => ' ',
                    'SERI BARANG' => ' ',
                    'KODE' => ' ',
                    'URAIAN' => ' '
                ];
 
            }
            
            if($key == 'BARANGVD'){
                $arrSementara = [
                    'NOMOR AJU' => ' ',
                    'SERI BARANG' => ' ',
                    'KODE VD' => ' ',
                    'NILAI BARANG' => ' ',
                    'BIAYA TAMBAHAN' => ' ',
                    'BIAYA PENGURANG' => ' ',
                    'JATUH TEMPO' => ' '
                ];
 
            }

            if($key == 'BAHANBAKU'){
                $arrSementara = [
                    'NOMOR AJU' => ' ',
                    'SERI BARANG' => ' ',
                    'KODE VD' => ' ',
                    'NILAI BARANG' => ' ',
                    'BIAYA TAMBAHAN' => ' ',
                    'BIAYA PENGURANG' => ' ',
                    'JATUH TEMPO' => ' '
                ];

            }

            if($key == 'BAHANBAKUTARIF'){
                $arrSementara = [
                    'NOMOR AJU' => ' ',
                    'SERI BARANG' => ' ',
                    'SERI BAHAN BAKU' => ' ',
                    'KODE ASAL BAHAN BAKU' => ' ',
                    'HS' => ' ',
                    'KODE BARANG' => ' ',
                    'URAIAN' => ' ',
                    'MEREK' => ' ',
                    'TIPE' => ' ',
                    'UKURAN' => ' ',
                    'SPESIFIKASI LAIN' => ' ',
                    'KODE SATUAN' => ' ',
                    'JUMLAH SATUAN' => ' ',
                    'KODE KEMASAN' => ' ',
                    'JUMLAH KEMASAN' => ' ',
                    'KODE DOKUMEN ASAL' => ' ',
                    'KODE KANTOR ASAL' => ' ',
                    'NOMOR DAFTAR ASAL' => ' ',
                    'TANGGAL DAFTAR ASAL' => ' ',
                    'NOMOR AJU ASAL' => ' ',
                    'SERI BARANG ASAL' => ' ',
                    'NETTO' => ' ',
                    'BRUTO' => ' ',
                    'VOLUME' => ' ',
                    'CIF' => ' ',
                    'CIF RUPIAH' => ' ',
                    'NDPBM' => ' ',
                    'HARGA PENYERAHAN' => ' ',
                    'HARGA PEROLEHAN' => ' ',
                    'NILAI JASA' => ' ',
                    'SERI IZIN' => ' ',
                    'VALUTA' => ' ',
                    'KODE BKC' => ' ',
                    'KODE KOMODITI BKC' => ' ',
                    'KODE SUB KOMODITI BKC' => ' ',
                    'FLAG TIS' => ' ',
                    'ISI PER KEMASAN' => ' ',
                    'JUMLAH DILEKATKAN' => ' ',
                    'JUMLAH PITA CUKAI' => ' ',
                    'HJE CUKAI' => ' ',
                    'TARIF CUKAI' => ' '
                ];
 
            }

            if($key == 'BAHANBAKUDOKUMEN'){
                $arrSementara = [
                    'NOMOR AJU' => ' ',
                    'SERI BARANG' => ' ',
                    'SERI BAHAN BAKU' => ' ',
                    'KODE_ASAL_BAHAN_BAKU' => ' ',
                    'SERI DOKUMEN' => ' ',
                    'SERI IZIN' => ' '
                ];
            }

            if($key == 'PUNGUTAN'){
                $arrSementara = [
                    'NOMOR AJU' => ' ',
                    'KODE FASILITAS TARIF'  => ' ',
                    'KODE JENIS PUNGUTAN' => ' ',
                    'NILAI PUNGUTAN' => ' ', 
                    'NPWP BILLING'  => ' '
                ];
            }
           
            if($key == 'JAMINAN'){
                $arrSementara = [
                    'NOMOR AJU' => ' ',
                    'KODE KANTOR' => ' ',
                    'KODE JAMINAN' => ' ',
                    'NOMOR JAMINAN' => ' ',
                    'TANGGAL JAMINAN' => ' ',
                    'NILAI JAMINAN' => ' ',
                    'PENJAMIN' => ' ',
                    'TANGGAL JATUH TEMPO' => ' ',
                    'NOMOR BPJ' => ' ',
                    'TANGGAL BPJ' => ' '
                ];
            }

            if($key == 'BANKDEVISA'){
                $arrSementara = [
                    'NOMOR AJU' => ' ',
                    'SERI' => ' ',
                    'KODE' => ' ',
                    'NAMA' => ' '
                ];
            }

            if($key == 'VERSI'){
                $arrSementara = [
                    'VERSI' => '1.1'
                ];
            }  
            
            $sheets[] = new PerSheetFtz0101Export($key, $sheetsName[$key], $data);
        } 
        return $sheets;
    }   
}

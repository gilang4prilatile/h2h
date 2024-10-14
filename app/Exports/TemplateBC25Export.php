<?php

namespace App\Exports;

use App\Models\BcForm;
use App\Models\GoodConversion;
use App\Models\HsCode;
use App\Models\Inbound;
use App\Models\InboundDocument;
use App\Models\InventoryOutboundDetail;
use App\Models\OutboundDetail;
use App\Models\OutboundDocument;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use PhpParser\Node\Stmt\TryCatch;
use PHPUnit\Framework\Constraint\Count;

class TemplateBC25Export implements WithMultipleSheets
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
                'KODE ASAL BAHAN BAKU'
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
            ],
            'Billing' => [
                'NOMOR AJU',
                'JENIS TARIF',
                'NPWP BILLING'
            ],
            'Pungutan' => [
                'NOMOR AJU',
                'JENIS TARIF',
                'KODE FASILITAS',
                'NILAI PUNGUTAN'
            ]

        ];


        $sheets = [];
        $data = [];
        $keys = array_keys($sheetsName);

        foreach($keys as $key){

            $data = [];
            
            if($key == 'Dokumen'){

                $inbounds = [];

                foreach($this->outbound->inventoryOutboundDetail as $inventoryOutboundDetail){
                    if(!in_array($inventoryOutboundDetail->inbound->id, $inbounds)){
                        $inbounds[] = $inventoryOutboundDetail->inbound->id;
                    }
                }

                foreach($this->outbound->outboundDocuments as $ind=>$outboundDocument){

                    $data[$ind]['nomer_aju'] = $this->outbound->request_number ?? '';
                    $data[$ind]['seri_dokumen'] = $ind+1 ?? '';
                    $data[$ind]['flag_url_dokumen'] = '';
                    $data[$ind]['kode_jenis_dokumen'] = $outboundDocument->document_id ?? '';
                    $data[$ind]['nomor_dokumen'] = $outboundDocument->details['nomor_dokumen'] ?? '';
                    $data[$ind]['tanggal_dokumen'] = date('d M Y', strtotime($outboundDocument->details['date'])) ?? '';
                    $data[$ind]['tipe_dokumen'] = '';
                    // $data[$ind]['tipe_dokumen'] = $outboundDocument->masterDocument->name ?? '';
                    $data[$ind]['url_dokumen'] = '';

                }

                for($i = 1; $i <= count($inbounds); $i++){

                    $inboundnya = Inbound::find($inbounds[$i-1]);
                    // dd($inboundnya->created_at);

                    $data[$ind+$i]['nomer_aju'] = $this->outbound->request_number ?? '';
                    $data[$ind+$i]['seri_dokumen'] = $ind+$i+1 ?? '';
                    $data[$ind+$i]['flag_url_dokumen'] = '';
                    $data[$ind+$i]['kode_jenis_dokumen'] = 380;
                    // $data[$ind+$i]['kode_jenis_dokumen'] = $inboundnya->document_id ?? '';
                    $data[$ind+$i]['nomor_dokumen'] = $inboundnya->request_number ?? '';
                    $data[$ind+$i]['tanggal_dokumen'] = date_format($inboundnya->created_at, 'd M Y') ?? '';
                    $data[$ind+$i]['tipe_dokumen'] = '';
                    // if($inboundnya->bc_form_id == 1){
                        
                    // $data[$ind+$i]['tipe_dokumen'] = "BC 4.0" ?? '';
                    // }
                    // else{
                    // $data[$ind+$i]['tipe_dokumen'] = "BC 2.3" ?? '';
                    // }

                    $data[$ind+$i]['url_dokumen'] = '';
                }
            }

            $jumlahbarang = $this->outbound->outboundDetails;
            $jumlahbar = 0;
            $jumlahkem = 0;
            foreach ($jumlahbarang as $barang) {
                // $jumlahbar += $barang->quantity;
                $jumlahbar += 1;
                $jumlahkem += $barang->package_details['jumlah'];
            }

            if($key == 'Header'){

                $kodenegarapemasok= DB::table('countries')->where('id','=', $this->outbound->outboundTpb->profile->country_id)->first();
               
                $arrSementara = [
                    'NOMOR AJU' => $this->outbound->request_number ?? '',
                    'KPPBC' => $this->outbound->outboundKppbc->masterKppbc->code ?? '',
                    'PERUSAHAAN' => $this->outbound->outboundTpb->profile->name ?? '',
                    'STATUS' => '01',
                    'KODE DOKUMEN PABEAN' => '25',
                    'ALAMAT PEMILIK' => $this->outbound->outboundPemilikBarang->profile->address ?? '',
                    'ALAMAT PENGUSAHA' => $this->outbound->outboundTpb->profile->address ?? '',
                    'ALAMAT PENERIMA BARANG' => $this->outbound->outboundPenerimaBarang->profile->address ?? '',
                    'API PEMILIK' => $this->outbound->outboundPemilikBarang->profile->details['nomor_api'] ?? '',
                    'API PENERIMA' => $this->outbound->outboundPenerimaBarang->profile->details['nomor_api'] ?? '',
                    'API PENGUSAHA' => $this->outbound->outboundTpb->profile->details['nomor_api'] ?? '',
                    'ASURANSI' => $this->outbound->details['asuransi'] ?? '',
                    'BIAYA TAMBAHAN' => $this->outbound->details['biaya_penambah'] ?? '',
                    'BRUTO' => $this->outbound->details['berat_kotor'] ?? '',
                    'CIF' => $this->outbound->details['nilai_cif'] ?? '',
                    'CIF RUPIAH' => $this->outbound->details['cif_rp'] ?? '',
                    'FOB' => $this->outbound->details['fob'] ?? '',
                    'FREIGHT' => $this->outbound->details['freight'] ?? '',
                    'ID PEMILIK' => $this->outbound->outboundPemilikBarang->details['nomor_identitas'] ?? '',
                    'ID PENERIMA BARANG' => $this->outbound->outboundPenerimaBarang->details['nomor_identitas'] ?? '',
                    'ID PENGUSAHA' => $this->outbound->outboundTpb->details['nomor_identitas'] ?? '',
                    'JUMLAH BARANG' => $jumlahbar ?? '',
                    'JUMLAH KEMASAN' => $jumlahkem ?? '',
                    'JUMLAH KONTAINER' => $this->outbound->details['jenis_peti_kemas'] == '8 - FCL' ? 2 : '',
                    'KODE BENDERA' => $this->outbound->outboundTransportation->country_code ?? '',
                    'KODE CARA ANGKUT' => $this->outbound->details['transport_line_id'] ?? '',
                    'KODE ID PEMILIK' => $this->outbound->outboundPemilikBarang->profile->id ?? '',
                    'KODE ID PENERIMA BARANG' => $this->outbound->outboundPenerimaBarang->profile->id ?? '',
                    'KODE ID PENGUSAHA' => $this->outbound->outboundTpb->profile->id ?? '',
                    'KODE JENIS API PEMILIK' => 1,
                    'KODE JENIS API PENERIMA' => 1,
                    'KODE JENIS API PENGUSAHA' => 1,
                    // 'KODE JENIS API PEMILIK' => $this->outbound->outboundPemilikBarang->profile->details['tipe_api'] ?? '',
                    // 'KODE JENIS API PENERIMA' => $this->outbound->outboundPenerimaBarang->profile->details['tipe_api'] ?? '',
                    // 'KODE JENIS API PENGUSAHA' => $this->outbound->outboundTpb->profile->details['tipe_api'] ?? '',
                    'KODE JENIS TPB' => $this->outbound->outboundJenisTpb->masterJenisTpb->code ?? '',
                    'KODE KANTOR BONGKAR' => $this->outbound->outboundKppbcBongkar->masterKppbc->code ?? '',
                    'KODE VALUTA' => $this->outbound->outboundValas->masterValas->code ?? '', 
                    'KODE LOKASI BAYAR' => 1,
                    'KODE PEMBAYAR' => 1,
                    'ID MODUL' => 29205,
                    'JABATAN TTD' => $this->outbound->details['pabean_jabatan'] ?? '',
                    'KOTA TTD' => $this->outbound->city->city ?? '',
                    'NAMA PEMILIK' => $this->outbound->outboundPemilikBarang->profile->name ?? '',
                    'NAMA PENERIMA BARANG' => $this->outbound->outboundPenerimaBarang->profile->name ?? '',
                    'NAMA PENGANGKUT' => $this->outbound->outboundTransportation->transportation->name ?? '',
                    'NAMA TTD' => $this->outbound->details['pabean_pemberitahu'] ?? '',
                    'NDPBM' => $this->outbound->details['ndpbm'] ?? '',
                    'NETTO' => $this->outbound->details['berat_bersih'] ?? '',
                    'NIPER PENERIMA' => $this->outbound->outboundPenerimaBarang->profile->details['niper'],
                    // 'NOMOR IJIN BPK PENGUSAHA' => $this->outbound->outboundTpb->profile->details['nomor_izin'] ?? '',
                    'NOMOR IJIN BPK PENGUSAHA' => '',
                    'NOMOR IJIN TPB' => $this->outbound->outboundTpb->profile->details['nomor_izin'] ?? '',
                    'NOMOR VOYV FLIGHT' => $this->outbound->outboundTransportation->vehicle_number ?? '',
                    'NPWP BILLING' => '922051578117000',
                    'TANGGAL TTD' => date('d M Y', strtotime($this->outbound->details['pabean_tanggal'])) ?? '',
                    'TOTAL BAYAR' => '' ,
                    'TOTAL BEBAS' => $this->outbound->details['total_dibebaskan'] ?? '',
                    'TOTAL TANGGUH' => $this->outbound->details['total_ditangguhkan'] ?? '',
                    'TOTAL TIDAK DIPUNGUT' => $this->outbound->details['total_tidak_dipungut'] ?? '',
                    'VERSI MODUL' => '3.1.11',

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
                $barandInd = 0;
                $seribarang = 0;
                if ($this->outbound->details['type_calculate'] == 1){
                    foreach($this->outbound->outboundDetails as $outboundDetail) {
                        $seribarang++;
                        foreach($outboundDetail->outboundDetailRawGoods as $keyseri=>$detailrawgood){
                            $barandInd++;
                            
                            $inboundDocument = InboundDocument::where('inbound_detail_id', $detailrawgood->inbound_detail_id)->first();

                            $arrSementara = [
                                'NOMOR AJU' => $this->outbound->request_number ?? '',
                                'SERI BARANG' => $seribarang ?? '',
                                'SERI BAHAN BAKU' => $keyseri+1 ?? '',
                                'CIF' => $detailrawgood->details['nilai_cif'] ?? '',
                                'CIF RUPIAH' => $detailrawgood->details['cif_rp'] ?? '',
                                'HARGA PENYERAHAN' => $detailrawgood->details['harga_penyerahan'] ?? '',
                                'HARGA PEROLEHAN' => $detailrawgood->details['harga_perolehan'] ?? '',
                                'JENIS SATUAN' => $detailrawgood->good->uom->code,
                                // 'JENIS SATUAN' => $detailrawgood->good->uom->name  ?? '',
                                'JUMLAH SATUAN' => $detailrawgood->quantity ?? '',
                                // 'KODE ASAL BAHAN BAKU' => '',
                                'KODE ASAL BAHAN BAKU' =>  $detailrawgood->bc_form_id == 3 ? '0' : '1',
                                'KODE BARANG' => $detailrawgood->kode_barang ?? '',
                                'KODE FASILITAS' => $outboundDetail->details['fasilitas'] ?? '',
                                // 'KOZDE JENIS DOK ASAL' => '',
                                'KOZDE JENIS DOK ASAL' => $detailrawgood->bc_form_id == 1 ? 'BC40' : 'BC23',
                                'KODE KANTOR' => $this->outbound->outboundKppbc->masterKppbc->code ?? '',
                                'KODE SKEMA TARIF' => '',
                                // 'KODE STATUS' => '',
                                'KODE STATUS' => '03',
                                'MERK' => $detailrawgood->bc_form_id == 3 ? 'PT. AICE SUMATERA INDUSTRY MADE IN CHINA' : '',
                                // 'MERK' =>  $detailrawgood->details['merk'] ?? '',
                                'NDPBM' => $detailrawgood->bc_form_id == 1 ? 1000 : '',
                                // 'NDPBM' => $detailrawgood->details['ndpbm'] ?? '',
                                'NETTO'=> $detailrawgood->nett_weight ?? '',
                                'NOMOR AJU DOKUMEN ASAL' => $detailrawgood->inboundDetail->inbound->request_number ?? '',
                                'NOMOR DAFTAR DOKUMEN ASAL' => $detailrawgood->inboundDetail->inbound->details['nomor_pendaftaran'] ?? '',
                                'POS TARIF' => HsCode::find($detailrawgood->hs_code_id)->code ?? '',
                                'SERI BARANG DOKUMEN ASAL' => $inboundDocument->seri_barang ?? '',
                                'SPESIFIKASI LAIN' =>  $detailrawgood->details['spesifikasi_lain'] ?? '',
                                'TANGGAL DAFTAR DOKUMEN ASAL' => date('d M Y', strtotime($detailrawgood->inboundDetail->inbound->details['tanggal_pendaftaran'])),
                                'TIPE' => '',
                                // 'TIPE' => $detailrawgood->details['type'] ?? '',
                                'UKURAN' => '',
                                // 'UKURAN' => $detailrawgood->details['ukuran'] ?? '',
                                'URAIAN' =>  $detailrawgood->details['uraian'] ?? '',
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
                else {
                    
                    foreach($this->outbound->outboundDetails as $outboundDetail) {
                        $seribarang++;
                        foreach($outboundDetail->inventoryOutboundDetail as $keyseri=>$detailrawgood){
                            $barandInd++;

                            $inboundDocument = InboundDocument::where('inbound_detail_id', $detailrawgood->inbound_detail_id)->first();

                            $arrSementara = [
                                'NOMOR AJU' => $this->outbound->request_number ?? '',
                                'SERI BARANG' => $seribarang ?? '',
                                'SERI BAHAN BAKU' => $keyseri+1 ?? '',
                                // 'CIF' => $detailrawgood->details['nilai_cif'] ?? '',
                                // 'CIF RUPIAH' => $detailrawgood->details['cif_rp'] ?? '',
                                // 'HARGA PENYERAHAN' => $detailrawgood->details['harga_penyerahan'] ?? '',
                                'HARGA PEROLEHAN' => '',
                                'JENIS SATUAN' => $detailrawgood->good->uom->name  ?? '',
                                'JUMLAH SATUAN' => $detailrawgood->quantity_outbound ?? '',
                                'KODE ASAL BAHAN BAKU' => $detailrawgood->bc_form_id == 3 ? '0' : '1',
                                'KODE BARANG' => $detailrawgood->good->kode_barang ?? '',
                                'KODE FASILITAS' => $outboundDetail->details['fasilitas'] ?? '',
                                'KOZDE JENIS DOK ASAL' => '',
                                'KODE KANTOR' => $this->outbound->outboundKppbc->masterKppbc->code ?? '',
                                'KODE SKEMA TARIF' => '',
                                'KODE STATUS' => '',
                                'MERK' => $detailrawgood->good->details['merk'] ?? '',
                                'NDPBM' => $detailrawgood->good->details['ndpbm'] ?? '',
                                // 'NETTO'=> $detailrawgood->nett_weight ?? '',
                                'NOMOR AJU DOKUMEN ASAL' => $detailrawgood->inboundDetail->inbound->request_number ?? '',
                                'NOMOR DAFTAR DOKUMEN ASAL' => $detailrawgood->inboundDetail->inbound->details['nomor_pendaftaran'] ?? '',
                                'POS TARIF' => HsCode::find($detailrawgood->hs_code_id)->code ?? '',
                                'SERI BARANG DOKUMEN ASAL' => $inboundDocument->seri_barang ?? '',
                                'SPESIFIKASI LAIN' =>  $detailrawgood->good->details['spesifikasi_lain'] ?? '',
                                'TANGGAL DAFTAR DOKUMEN ASAL' => date('d M Y', strtotime($detailrawgood->inboundDetail->inbound->details['tanggal_pendaftaran'])) ?? '',
                                'TIPE' => $detailrawgood->good->details['type'] ?? '',
                                'UKURAN' => $detailrawgood->good->details['ukuran'] ?? '',
                                'URAIAN' =>  $detailrawgood->good->details['uraian'] ?? '',
                            ];

                            for($i = 0 ; $i < count($sheetsName['Bahan Baku']) ; $i++){

                                $keySementara = array_keys($arrSementara);

                                foreach($keySementara as $keySem){

                                    if($sheetsName['Bahan Baku'][$i] === $keySem){
                                        $data[$barandInd][$sheetsName['Bahan Baku'][$i]] = $arrSementara[$keySem];
                                        break;
                                    }

                                    $data[$barandInd][$sheetsName['Bahan Baku'][$i]] = '';
                                }
                            }

                        }

                    }
                }

            }
            

            if($key == 'BahanBakuTarif'){
                $barangdetail = 0;
                $angka = 0;
                $seribahanbaku = 1;
                $outbound_detail_id_tanda = 0;
                $total_tarif['bm'] = 0;
                $total_tarif['ppn'] = 0;
                $total_tarif['pph'] = 0;

                foreach($this->outbound->outboundDetails as $outboundDetails){
                    foreach($outboundDetails->outboundDetailRawGoods as $detailrawgood){
                            
                            if($detailrawgood->bc_form_id == 3){

                                $otb = $detailrawgood->details;

                                $total_tarif['bm'] = $total_tarif['bm'] + $otb['bm_tax_value'] ?? 0;
                                $total_tarif['ppn'] = $total_tarif['ppn'] + $otb['ppn_tax_value'] ?? 0;
                                $total_tarif['pph'] = $total_tarif['pph'] + $otb['pph_tax_value'] ?? 0;

                                
                            }

                            // nomor Seri barang
                            if($outbound_detail_id_tanda != $detailrawgood->outbound_detail_id){
                                $angka ++;
                                $outbound_detail_id_tanda = $detailrawgood->outbound_detail_id;
                            }


                            if ($detailrawgood->bc_form_id == 3){
                            $arrayku = ['bm','ppn','ppnbm','pph'];
                            }
                            else{
                            $arrayku = ['ppn'];
                            }

                            $outboundDetailsss = $detailrawgood->details;

                            $kodeasalbahanbaku = $detailrawgood->bc_form_id == 3 ? '0' : '1';
                   
                            foreach($arrayku as $arrayku){ 
                                // if (in_array($arrayku,$outboundDetailsss)){
                                    $KodeFasilitas = 0;
                                    $jenistarif = 0;
                                if($outboundDetailsss[$arrayku] != 0){
                                    
                                    if($outboundDetailsss[$arrayku.'_tax_type'] == '1'){
                                        $KodeFasilitas = 2;
                                    }
                                    if($outboundDetailsss[$arrayku.'_tax_type'] == '5'){
                                        $KodeFasilitas = 4;
                                    }
                                    if($outboundDetailsss[$arrayku.'_tax_type'] == '6'){
                                        $KodeFasilitas = 5;
                                    }

                                    if($arrayku == 'bm')
                                    {
                                        $jenistarif = 'BM';
                                        $tarif = $outboundDetailsss['bm'];
                                        $tarif_fasi = $outboundDetailsss['bm_tax_value'];
                                    }
                                    if($arrayku == 'ppn')
                                    {
                                        $jenistarif = 'PPN';
                                        $tarif = $outboundDetailsss['ppn'];
                                        $tarif_fasi = $outboundDetailsss['ppn_tax_value'];
                                    }
                                    if($arrayku == 'ppnbm')
                                    {
                                        $jenistarif = 'PPNBM';
                                        $tarif = $outboundDetailsss['ppnbm'];
                                        $tarif_fasi = $outboundDetailsss['ppnbm_tax_value'];
                                    }
                                    if($arrayku == 'pph')
                                    {
                                        $jenistarif = 'PPH';
                                        $tarif = $outboundDetailsss['pph'];
                                        $tarif_fasi = $outboundDetailsss['pph_tax_value'];
                                    }
                                    if($arrayku == 'cukai')
                                    {
                                        $jenistarif = 'CUKAI';
                                        $tarif = $outboundDetailsss['cukai'];
                                        $tarif_fasi = $outboundDetailsss['cukai_tax_value'];
                                    } 

                                    $arrSementara = [
                                        'NOMOR AJU' => $this->outbound->request_number ?? '',
                                        'SERI BARANG'  => $angka ?? '',
                                        'SERI BAHAN BAKU' => $seribahanbaku ?? '', //Seri Barang
                                        'JENIS TARIF' => $jenistarif ?? '',//Seri Bahan Baku
                                        'JUMLAH SATUAN' => '',//Jenis Tarif
                                        'KODE ASAL BAHAN BAKU' => $kodeasalbahanbaku,
                                        'KODE FASILITAS' => $KodeFasilitas ?? '0',
                                        'KODE KOMODITI CUKAI' => '',
                                        'KODE SATUAN' => '',
                                        'KODE TARIF' => $KodeFasilitas ?? '',
                                        'NILAI BAYAR' => $total_tarif[$arrayku] ?? '',
                                        'NILAI FASILITAS' => '',
                                        'NILAI SUDAH DILUNASI' => '',
                                        'TARIF' =>  $tarif ?? '',
                                        'TARIF FASILITAS' => $tarif_fasi ?? ''
                                    ];
                                    
                            
                                    for($i = 0 ; $i < count($sheetsName['BahanBakuTarif']) ; $i++){
                    
                                        $keySementara = array_keys($arrSementara);
                                        foreach($keySementara as $keySem){
                                            
                                            if($sheetsName['BahanBakuTarif'][$i] === $keySem){
                                                $data[$barangdetail][$sheetsName['BahanBakuTarif'][$i]] = $arrSementara[$keySem];
                                                break;
                                            }
                                            
                                            $data[$barangdetail][$sheetsName['BahanBakuTarif'][$i]] = '';
                                            
                                        }
                                    } 
                                }
                                $barangdetail++;
                            }
                        // }
                    // }
                    $seribahanbaku++;
                    }
                }

            }

            if($key == 'BahanBakuDokumen') {
                // $barandInd = 0;
                // $inbounds = [];
                // $documents = [];

                // $outboundDocumentsDB = $this->outbound->outboundDocuments;
    
                // foreach($outboundDocumentsDB as $outboundDocument){
                //     $documents[] = $outboundDocument->seri_document;
                // }
            
                // foreach($this->outbound->inventoryOutboundDetail as $inventoryOutboundDetail){
                //     if(!in_array($inventoryOutboundDetail->inbound_id, $inbounds)){
                //         $inbounds[] = $inventoryOutboundDetail->inbound_id;
                //     }
                // }
                
                // $outboundDocumentWithInbounds = array_merge($documents, $inbounds);
            
                // foreach($this->outbound->outboundDetails as $keyOutboundDetail=>$outboundDetail){
                //     $goodConversions = GoodConversion::where('good_id', $outboundDetail->good_id)->get();
                //     foreach($goodConversions as $keyGood=>$goodConversion){
                //         $outboundDocuments = OutboundDocument::where('outbound_detail_id', $outboundDetail->id)->get();
                //         foreach($outboundDocumentWithInbounds as $keySeriDoc=>$outboundDocumentWithInbound){
                          
                //             foreach($outboundDocuments as $outboundDocument){

                //                 if($outboundDocument->seri_document == ( $keySeriDoc + 1 ) && ($keySeriDoc + 1 ) <= count($documents)){
                //                     $barandInd++;
                //                     $arrSementara = [
                //                         'NOMOR AJU' => $this->outbound->request_number ?? '',
                //                         'SERI BARANG' => ( $keyOutboundDetail + 1 ) ?? '',
                //                         'SERI BAHAN BAKU' => ($keyGood + 1) ?? '',
                //                         'SERI DOKUMEN' => ( $keySeriDoc + 1 ) ?? '',
                //                     ];
                //                     for ($i = 0; $i < count($sheetsName['BahanBakuDokumen']); $i++) {
    
                //                         $keySementara = array_keys($arrSementara);
                //                         foreach ($keySementara as $keySem) {
                //                             if ($sheetsName['BahanBakuDokumen'][$i] === $keySem) {
                //                                 $data[$barandInd][$sheetsName['BahanBakuDokumen'][$i]] = $arrSementara[$keySem];
                //                                 break;
                //                             }
    
                //                             $data[$barandInd][$sheetsName['BahanBakuDokumen'][$i]] = '';
    
    
                //                         }
                //                     }

                //                     break;
                                
                //                 }else if(($keySeriDoc + 1 ) > count($documents) && InventoryOutboundDetail::where('inbound_id', $outboundDocumentWithInbound)
                //                             ->where('outbound_id', $this->outbound->id)
                //                             ->where('outbound_detail_id', $outboundDetail->id)
                //                             ->where('good_id', $goodConversion->good_conversion_id)
                //                             ->count() > 0) {
    
                //                     $barandInd++;
                //                     $arrSementara = [
                //                         'NOMOR AJU' => $this->outbound->request_number ?? '',
                //                         'SERI BARANG' => ( $keyOutboundDetail + 1 ) ?? '',
                //                         'SERI BAHAN BAKU' => ($keyGood + 1) ?? '',
                //                         'SERI DOKUMEN' => ( $keySeriDoc + 1 ) ?? '',
                //                     ];
    
                //                     for ($i = 0; $i < count($sheetsName['BahanBakuDokumen']); $i++) {
    
                //                         $keySementara = array_keys($arrSementara);
                //                         foreach ($keySementara as $keySem) {
                //                             if ($sheetsName['BahanBakuDokumen'][$i] === $keySem) {
                //                                 $data[$barandInd][$sheetsName['BahanBakuDokumen'][$i]] = $arrSementara[$keySem];
                //                                 break;
                //                             }
    
                //                             $data[$barandInd][$sheetsName['BahanBakuDokumen'][$i]] = '';
    
    
                //                         }
                //                     }

                //                     break;

                //                 }

                //             }
            
                //         }
            
            
            
                //     }
                // }
            }
            // }

            if($key == 'Barang'){
                $seribarangs = 1;

                foreach($this->outbound->outboundDetails as $barandInd=>$outboundDetail){

                    $outbounddetailraw = $outboundDetail->inventoryOutboundDetail;
                    $jumlahbaku = Count($outbounddetailraw);

                    $arrSementara = [
                        'NOMOR AJU' => $this->outbound->request_number ?? '',
                        'SERI BARANG' => $seribarangs ?? '',
                        'CIF' => $outboundDetail->details['nilai_cif'] ?? '',
                        'CIF RUPIAH' => $outboundDetail->details['cif_rp'] ?? '',
                        'HARGA PENYERAHAN' => $outboundDetail->details['harga_penyerahan'] ?? '',
                        'JUMLAH BAHAN BAKU' => $jumlahbaku,
                        'JUMLAH KEMASAN' => $outboundDetails->package_details['jumlah'],
                        'JUMLAH SATUAN' => $outboundDetail->quantity ?? '',
                        'KATEGORI BARANG' => 'Hasil Produksi',
                        'KODE BARANG' => $outboundDetail->details['kode_barang'] ?? '',
                        'KODE FASILITAS' => $outboundDetail->details['fasilitas'] ?? '',
                        'KODE KEMASAN' => $outboundDetail->package->code ?? '',
                        'KODE SATUAN' => $outboundDetail->good->uom->code ?? '',
                        'KODE NEGARA ASAL' => 'ID',
                        'MERK' => $outboundDetail->details['merk'] ?? '',
                        'NETTO' => $outboundDetail->nett_weight ?? '',
                        'POS TARIF' => $outboundDetail->hsCode->code,
                        'TIPE' => $outboundDetail->details['type'] ?? '',
                        'URAIAN' => $outboundDetail->details['uraian'] ?? '',
                        'VOLUME' => $outboundDetail->volume ?? ''
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
                    $seribarangs++;

                }

            }

            if($key == 'BarangTarif'){
                $barangdetail = 0;
                $angka = 1;
                
                foreach($this->outbound->outboundDetails as $barandInd=>$outboundDetail){

                    $arrayku = ['bm','ppn','ppnbm','pph'];

                    foreach($arrayku as $arrayku){
                            $KodeFasilitas = 0;
                            $jenistarif = 0;

                    // if (in_array($arrayku,$outboundDetail->details)){
                        try {

                            if($outboundDetail->details[$arrayku]!= 0){ 
                                
                                if($outboundDetail->details[$arrayku.'_tax_type'] == '1'){
                                    $KodeFasilitas = 2;
                                }
                                if($outboundDetail->details[$arrayku.'_tax_type'] == '5'){
                                    $KodeFasilitas = 4;
                                }
                                if($outboundDetail->details[$arrayku.'_tax_type'] == '6'){
                                    $KodeFasilitas = 5;
                                }

                                if($arrayku == 'bm')
                                {
                                    $jenistarif = 'BM';
                                    $tarif = $outboundDetail->details['bm'];
                                    $tarif_fasi = $outboundDetail->details['bm_tax_value'];
                                }
                                if($arrayku == 'ppn')
                                {
                                    $jenistarif = 'PPN';
                                    $tarif = $outboundDetail->details['ppn'];
                                    $tarif_fasi = $outboundDetail->details['ppn_tax_value'];
                                }
                                if($arrayku == 'ppnbm')
                                {
                                    $jenistarif = 'PPNBM';
                                    $tarif = $outboundDetail->details['ppnbm'];
                                    $tarif_fasi = $outboundDetail->details['ppnbm_tax_value'];
                                }
                                if($arrayku == 'pph')
                                {
                                    $jenistarif = 'PPH';
                                    $tarif = $outboundDetail->details['pph'];
                                    $tarif_fasi = $outboundDetail->details['pph_tax_value'];
                                }
                                if($arrayku == 'cukai')
                                {
                                    $jenistarif = 'CUKAI';
                                    $tarif = $outboundDetail->details['cukai'];
                                    $tarif_fasi = $outboundDetail->details['cukai_tax_value'];
                                } 

                                $arrSementara = [
                                    'NOMOR AJU' => $this->outbound->request_number ?? '',
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
                        } catch (\Throwable $th) {
                            //throw $th;
                        }
                    $barangdetail++;
                    }
                    $angka++;
                }

            }

            if($key == 'BarangDokumen'){
                // foreach($this->outbound->outboundDocuments as $barandInd=>$barangdoku){

                //     if($barangdoku->document_id != 104){
                //         $arrSementara = [
                //         'NOMOR AJU' => $this->outbound->request_number ?? '',
                //         'SERI BARANG' => $barangdoku->seri_barang ?? '',
                //         'SERI DOKUMEN' => $barangdoku->seri_document ?? ''
                //         ];

                //         for($i = 0 ; $i < count($sheetsName['BarangDokumen']) ; $i++){
        
                //             $keySementara = array_keys($arrSementara);
                //             foreach($keySementara as $keySem){
                                
                //                 if($sheetsName['BarangDokumen'][$i] === $keySem){
                //                     $data[$barandInd][$sheetsName['BarangDokumen'][$i]] = $arrSementara[$keySem];
                //                     break;
                //                 }
                                
                //                 $data[$barandInd][$sheetsName['BarangDokumen'][$i]] = '';
                //             }
                //         }
                //     }

                // }
            }

            if($key == 'Kemasan'){

                $arrSementara = [
                    'NOMOR AJU' => $this->outbound->request_number ?? '',
                    'JUMLAH KEMASAN' => $this->outbound->outboundDetails[0]->package_details['jumlah'] ?? '',
                    'KODE JENIS KEMASAN' => $this->outbound->outboundDetails[0]->package->code ?? '',
                    'MEREK KEMASAN' => $this->outbound->outboundDetails[0]->package_details['merk'] ?? ''
                    
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

                // foreach($this->outbound->outboundDetails as $barandInd=>$outboundDetail){

                //     $arrSementara = [
                //         'NOMOR AJU' => $this->outbound->request_number ?? '',
                //         'JUMLAH KEMASAN' => $outboundDetail->package_details['jumlah'] ?? '',
                //         'KODE JENIS KEMASAN' => $outboundDetail->package->code ?? '',
                //         'MEREK KEMASAN' => $outboundDetail->package_details['merk'] ?? ''
                        
                //     ];
    
                //     for($i = 0 ; $i < count($sheetsName['Kemasan']) ; $i++){
    
                //         $keySementara = array_keys($arrSementara);
                //         foreach($keySementara as $keySem){
                            
                //             if($sheetsName['Kemasan'][$i] === $keySem){
                //                 $data[$barandInd][$sheetsName['Kemasan'][$i]] = $arrSementara[$keySem];
                //                 break;
                //             }
                            
                //             $data[$barandInd][$sheetsName['Kemasan'][$i]] = '';
                //         }
                //     }

                // }

            }

            
            if($key == 'Kontainer'){
                // $arrSementara = [
                //     'NOMOR AJU' => $this->outbound->request_number ?? '',
                //     'KODE TIPE KONTAINER' => $this->outbound->details['type_peti_kemas_id'] ?? '',
                //     'KODE UKURAN KONTAINER' => $this->outbound->details['ukuran_peti_kemas_id'] ?? '',
                //     'NOMOR KONTAINER' => $this->outbound->details['nomor_peti_kemas'] ?? ''
                    
                // ];

                // for($i = 0 ; $i < count($sheetsName['Kontainer']) ; $i++){

                //     $keySementara = array_keys($arrSementara);
                //     foreach($keySementara as $keySem){
                        
                //         if($sheetsName['Kontainer'][$i] === $keySem){
                //             $data[  0][$sheetsName['Kontainer'][$i]] = $arrSementara[$keySem];
                //             break;
                //         }
                        
                //         $data[0][$sheetsName['Kontainer'][$i]] = '';
                //     }
                // }
            }

            if($key == 'Billing'){
                $total_tarif['bm'] = 0;
                // $total_tarif['ppn'] = 0;
                // $total_tarif['ppnbm'] = 0;
                // $total_tarif['pph'] = 0;
                $barangdetail = 0;

                foreach($this->outbound->outboundDetails as $outboundDetails){
                    foreach($outboundDetails->outboundDetailRawGoods as $detailrawgood){
                        
                        if($detailrawgood->bc_form_id == 3){

                            $outboundDetailsss = $detailrawgood->details;

                            $total_tarif['bm'] = $total_tarif['bm'] + $outboundDetailsss['bm_tax_value'] ?? '';
                            // $total_tarif['ppn'] = $total_tarif['ppn'] + $outboundDetailsss['ppn_tax_value'] ?? '';
                            // $total_tarif['ppnbm'] = $total_tarif['ppnbm'] + $outboundDetailsss['ppnbm_tax_value'] ?? '';
                            // $total_tarif['pph'] = $total_tarif['pph'] + $outboundDetailsss['pph_tax_value'] ?? '';
                        }
                    }
                }

                // $arrayku = ['bm','ppn','ppnbm','pph'];
                $arrayku = ['bm'];
                foreach($arrayku as $arrayku){
                    $KodeFasilitas = 0;
                    $jenistarif = 0;

                    if($arrayku == 'bm')
                    {
                        $jenistarif = 'BM';
                    }
                    if($arrayku == 'ppn')
                    {
                        $jenistarif = 'PPN';
                    }
                    if($arrayku == 'ppnbm')
                    {
                        $jenistarif = 'PPNBM';
                    }
                    if($arrayku == 'pph')
                    {
                        $jenistarif = 'PPH';
                    }
                    if($arrayku == 'cukai')
                    {
                        $jenistarif = 'CUKAI';
                    } 

                    $arrSementara = [
                        'NOMOR AJU' => $this->outbound->request_number ?? '' ,
                        'JENIS TARIF' => $jenistarif ?? '',
                        'NPWP BILLING' => $total_tarif[$arrayku] ?? ''
                    ];
                    
                
                    for($i = 0 ; $i < count($sheetsName['Billing']) ; $i++){
    
                        $keySementara = array_keys($arrSementara);
                        foreach($keySementara as $keySem){
                            
                            if($sheetsName['Billing'][$i] === $keySem){
                                $data[$barangdetail][$sheetsName['Billing'][$i]] = $arrSementara[$keySem];
                                break;
                            }
                            
                            $data[$barangdetail][$sheetsName['Billing'][$i]] = '';
                            
                        }
                    } 
                    $barangdetail++;
                }
            }

            if($key == 'Pungutan'){
                $total_tarif['bm'] = 0;
                $total_tarif['ppn'] = 0;
                $total_tarif['pph'] = 0;
                $barangdetail = 0;

                foreach($this->outbound->outboundDetails as $outboundDetails){
                    foreach($outboundDetails->outboundDetailRawGoods as $detailrawgood){
                        
                        if($detailrawgood->bc_form_id == 3){

                            $outboundDetailsss = $detailrawgood->details;

                            $total_tarif['bm'] = $total_tarif['bm'] + $outboundDetailsss['bm_tax_value'] ?? '';
                            $total_tarif['ppn'] = $total_tarif['ppn'] + $outboundDetailsss['ppn_tax_value'] ?? '';
                            $total_tarif['pph'] = $total_tarif['pph'] + $outboundDetailsss['pph_tax_value'] ?? '';

                            $kode_fasilitas['bm'] = $outboundDetailsss['bm_tax_type'];
                            $kode_fasilitas['ppn'] = $outboundDetailsss['ppn_tax_type'];
                            $kode_fasilitas['pph'] = $outboundDetailsss['pph_tax_type'];
                        }
                    }
                }

                $arrayku = ['bm','ppn','pph'];

                foreach($arrayku as $arrayku){
                    $KodeFasilitas = 0;
                    $jenistarif = 0;

                    if($arrayku == 'bm')
                    {
                        $jenistarif = 'BM';
                    }
                    if($arrayku == 'ppn')
                    {
                        $jenistarif = 'PPN';
                    }
                    if($arrayku == 'pph')
                    {
                        $jenistarif = 'PPH';
                    }

                    $arrSementara = [
                        'NOMOR AJU' => $this->outbound->request_number ?? '' ,
                        'JENIS TARIF' => $jenistarif ?? '',
                        'KODE FASILITAS' => $kode_fasilitas[$arrayku] ?? 0,
                        'NILAI PUNGUTAN' => $total_tarif[$arrayku] ?? ''
                    ];
                    
                
                    for($i = 0 ; $i < count($sheetsName['Pungutan']) ; $i++){
    
                        $keySementara = array_keys($arrSementara);
                        foreach($keySementara as $keySem){
                            
                            if($sheetsName['Pungutan'][$i] === $keySem){
                                $data[$barangdetail][$sheetsName['Pungutan'][$i]] = $arrSementara[$keySem];
                                break;
                            }
                            
                            $data[$barangdetail][$sheetsName['Pungutan'][$i]] = '';
                            
                        }
                    } 
                    $barangdetail++;
                }
            }

            $sheets[] = new PerSheetBC25Export($key, $sheetsName[$key], $data);
        }

        return $sheets;
    }   
}

<?php

namespace App\Exports;

use App\Models\Country;
use App\Models\Inbound;
use App\Models\MasterIncoterm;
use App\Models\MasterKppbc;
use App\Models\MasterPackage;
use App\Models\MasterTypePetiKemas;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class TemplateBC30Export implements WithMultipleSheets
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
                'KODE GUDANG ASAL 1',
                'KODE GUDANG TUJUAN 1',
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
                'KODE GUDANG ASAL 2',
                'KODE GUDANG TUJUAN 2',
                'KODE NEGARA TUJUAN',
                'KODE TUTUP PU',
                'NOMOR BC11',
                'TANGGAL BC11',
                'NOMOR POS',
                'NOMOR SUB POS',
                'KODE PELABUHAN BONGKAR',
                'KODE PELABUHAN MUAT',
                'KODE PELABUHAN MUAT AKHIR',
                'KODE PELABUHAN EXPORT',
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
                'ASURANSI 1',
                'NILAI BARANG',
                'NILAI INCOTERM',
                'NILAI MAKLON',
                'ASURANSI 2',
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
        $exap = [];
        foreach($keys as $key){
            $data = [];
 
            if($key == 'HEADER'){

                // $nomorBC11 = DB::table('inbound_documents')->where('inbound_id','=',$this->inbound->id)->where('document_id','=',104)->first();
                // if($nomorBC11 != null)
                // $nomorBC11s = json_decode($nomorBC11->details);

                $transportid = $this->inbound->inboundTransportation->pluck('id');
                
                $unload     = DB::table('inbound_transportation_ports')->where('inbound_transportation_id','=',$transportid)->where('type','=','bongkar')->first();
                $load       = DB::table('inbound_transportation_ports')->where('inbound_transportation_id','=',$transportid)->where('type','=','muat')->first();
                $export     = DB::table('inbound_transportation_ports')->where('inbound_transportation_id','=',$transportid)->where('type','=','export')->first();
                $tujuan     = DB::table('inbound_transportation_ports')->where('inbound_transportation_id','=',$transportid)->where('type','=','tujuan')->first();

                $unloadport = DB::table('ports')->where('id','=',$unload->port_id)->first();
                $loadport   = DB::table('ports')->where('id','=',$load->port_id)->first();
                $exportport = DB::table('ports')->where('id','=',$export->port_id)->first();
                $tujuanport = DB::table('ports')->where('id','=',$tujuan->port_id)->first();

                $countryTujuanPort = Country::find($tujuanport->country_id);
                $officeCheckExport = MasterKppbc::find($this->inbound->details['office_check_export_id']);
                $incoterm = MasterIncoterm::find($this->inbound->details['hincoterm_id']);
                $arrSementara = [
                    'NOMOR AJU'                     => $this->inbound->request_number ?? '',
                    'KODE DOKUMEN'                  => 30,
                    'KODE KANTOR'                   => $this->inbound->inboundKppbc->masterKppbc->code ?? '',
                    'KODE KANTOR BONGKAR' => ' ',
                    'KODE KANTOR PERIKSA'           => $officeCheckExport->code ?? '',
                    'KODE KANTOR TUJUAN'            => ' ',
                    'KODE KANTOR EKSPOR'            => $this->inbound->inboundKppbc->masterKppbc->code ?? '',
                    'KODE JENIS IMPOR' => '',
                    'KODE JENIS EKSPOR'             => $this->inbound->peb_type_id ?? ' ',
                    'KODE JENIS TPB' => ' ',
                    'KODE JENIS PLB' => ' ',
                    'KODE JENIS PROSEDUR' => ' ',
                    'KODE TUJUAN PEMASUKAN' => ' ',
                    'KODE TUJUAN PENGIRIMAN' => ' ',
                    'KODE TUJUAN TPB' => ' ',
                    'KODE CARA DAGANG'              => $this->inbound->trade_type_id ?? '',
                    'KODE CARA BAYAR'               => $this->inbound->payment_type_id ?? '',
                    'KODE CARA BAYAR LAINNYA'       => '',
                    'KODE GUDANG ASAL 1' => ' ',
                    'KODE GUDANG TUJUAN 1' => ' ',
                    'KODE JENIS KIRIM' => ' ',
                    'KODE JENIS PENGIRIMAN' => ' ',
                    'KODE KATEGORI EKSPOR'          =>$this->inbound->inboundExportType->code ?? '',
                    'KODE KATEGORI MASUK FTZ' => ' ',
                    'KODE KATEGORI KELUAR FTZ' => ' ',
                    'KODE KATEGORI BARANG FTZ' => ' ',
                    'KODE LOKASI'                   => $this->inbound->details['location_check_export'],
                    'KODE LOKASI BAYAR' => ' ',
                    'LOKASI ASAL' => ' ',
                    'LOKASI TUJUAN' => ' ',
                    'KODE DAERAH ASAL' => ' ',
                    'KODE GUDANG ASAL 2' => ' ',
                    'KODE GUDANG TUJUAN 2' => ' ',
                    'KODE NEGARA TUJUAN'            => $countryTujuanPort->code,
                    'KODE TUTUP PU' => ' ',
                    'NOMOR BC11'                    => '',
                    'TANGGAL BC11'                  => '',
                    'NOMOR POS'                     => '',
                    'NOMOR SUB POS'                 => '',                    
                    'KODE PELABUHAN BONGKAR'        => $unloadport->code ?? '',
                    'KODE PELABUHAN MUAT'           => $loadport->code ?? '',
                    'KODE PELABUHAN MUAT AKHIR'     => ' ',
                    'KODE PELABUHAN EXPORT'         => $exportport->code ?? '',
                    'KODE PELABUHAN TUJUAN'         => $tujuanport->code ?? '',
                    'KODE PELABUHAN EKSPOR' => ' ',
                    'KODE TPS'                      => $officeCheckExport->code ?? '',
                    'TANGGAL BERANGKAT' => ' ',
                    'TANGGAL EKSPOR'                => $this->inbound->details['estimation_export_date'] ?? '',
                    'TANGGAL MASUK' => ' ',
                    'TANGGAL MUAT' => ' ',
                    'TANGGAL TIBA' => ' ',
                    'TANGGAL PERIKSA'               => $this->inbound->details['check_export_date'] ?? '',
                    'TEMPAT STUFFING' => ' ',
                    'TANGGAL STUFFING' => ' ',
                    'KODE TANDA PENGAMAN' => ' ',
                    'JUMLAH TANDA PENGAMAN' => ' ',
                    'FLAG CURAH'                    => $this->inbound->bulk_id ?? '',
                    'FLAG SDA'                      => $this->inbound->commodity_id ?? '',
                    'FLAG VD' => ' ',
                    'FLAG AP BK' => ' ',
                    'FLAG MIGAS'                    => $this->inbound->commodity_id ?? '',
                    'KODE ASURANSI'                 => $this->inbound->details['insurance'] ?? '',
                    'ASURANSI 1'                    => $this->inbound->details['insurance_value'] ?? '',
                    'NILAI BARANG' => '0',
                    'NILAI INCOTERM' => ' ',
                    'NILAI MAKLON'                  => $this->inbound->details['nilai_maklon'] ?? '',
                    'ASURANSI 2'                    => $this->inbound->details['insurance_value'] ?? '',
                    'FREIGHT'                       => $this->inbound->details['freight'] ?? '',
                    'FOB'                           => $this->inbound->details['fob'] ?? '',
                    'BIAYA TAMBAHAN'                => '0',
                    'BIAYA PENGURANG'               => '0',
                    'VD'                            => '0',
                    'CIF'                           => $this->inbound->details['fob_unit'] ?? '',
                    'HARGA_PENYERAHAN'              => '0',
                    'NDPBM'                         => $this->inbound->details['ndpbm'] ?? '',
                    'TOTAL DANA SAWIT' => ' ',
                    'DASAR PENGENAAN PAJAK' => ' ',
                    'NILAI JASA' => ' ',
                    'UANG MUKA' => ' ',
                    'BRUTO'                         => $this->inbound->details['bruto'] ?? '',
                    'NETTO'                         => $this->inbound->details['netto'] ?? '',
                    'VOLUME'                        => $this->inbound->details['volume'] ?? '',
                    'KOTA PERNYATAAN'               => $this->inbound->city->city ?? '',
                    'TANGGAL PERNYATAAN'            => $this->inbound->details['pabean_tanggal'] ?? '',
                    'NAMA PERNYATAAN'               => $this->inbound->details['pabean_pemberitahu'] ?? '',
                    'JABATAN PERNYATAAN'            => $this->inbound->details['pabean_jabatan'] ?? '',
                    'KODE VALUTA'                   => $this->inbound->inboundValas->masterValas->code ?? '',
                    'KODE INCOTERM'                 => $incoterm->code,
                    'KODE JASA KENA PAJAK' => ' ',
                    'NOMOR BUKTI BAYAR' => ' ',
                    'TANGGAL BUKTI BAYAR' => ' ',
                    'KODE JENIS NILAI' => ' ',
                    'KODE KANTOR MUAT'              => $this->inbound->inboundKppbcAsal->masterKppbc->code ?? '',
                    'NOMOR DAFTAR' => ' ',
                    'TANGGAL DAFTAR' => ' ',
                    'KODE ASAL BARANG FTZ' => ' ',
                    'KODE TUJUAN PENGELUARAN' => ' ',
                    'PPN PAJAK' => '0',
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

                $dataEntitas = [];

                $penerimaBarang = $this->inbound->inboundPenerimaBarang->profile->toArray();
                $dataEntitas[] = array_merge($penerimaBarang, [
                    'no_seri'       => 8,
                    'kode_entitas'  => 8
                ]);
                
                $ppjk = $this->inbound->inboundPPJK->profile->toArray();
                $dataEntitas[] = array_merge($ppjk, [
                    'no_seri'       => 4,
                    'kode_entitas'  => 4
                ]);

                $exportir = $this->inbound->inboundExportir->profile->toArray();
                $dataEntitas[] = array_merge($exportir, [
                    'no_seri'       => 2,
                    'kode_entitas'  => 2
                ]);

                $pembeliBarang = $this->inbound->inboundPembeliBarang->profile->toArray();
                $dataEntitas[] = array_merge($pembeliBarang, [
                    'no_seri'       => 6,
                    'kode_entitas'  => 6
                ]);

                $pemilikBarang = $this->inbound->inboundPemilikBarang->profile->toArray();
                $dataEntitas[] = array_merge($pemilikBarang, [
                    'no_seri'       => 13,
                    'kode_entitas'  => 7
                ]);

                foreach($dataEntitas as $entitasInd=>$entitas){

                    $arrSementara = [
                        'NOMOR AJU' => $this->inbound->request_number ?? '',
                        'SERI' => $entitas['no_seri'],
                        'KODE ENTITAS' => $entitas['kode_entitas'],
                        'KODE JENIS IDENTITAS' => $entitas['details']['jenis_identitas'] ?? '',
                        'NOMOR IDENTITAS' => $entitas['details']['nomor_identitas'] ?? '',
                        'NAMA ENTITAS' => $entitas['name'],
                        'ALAMAT ENTITAS' => $entitas['address'],
                        'NIB ENTITAS' => $entitas['details']['nib'] ?? '',
                        'KODE JENIS API' => ' ',
                        'KODE STATUS' => ' ',
                        'NOMOR IJIN ENTITAS' => ' ',
                        'TANGGAL IJIN ENTITAS' => ' ',
                        'KODE NEGARA' => $entitas['country_id'] != null ? Country::find($entitas['country_id'])->code : '',
                        'NIPER ENTITAS' => $entitas['details']['niper'] ?? ''
                    ];

                    for($i = 0 ; $i < count($sheetsName['ENTITAS']) ; $i++){

                        $keySementara = array_keys($arrSementara);
                        foreach($keySementara as $keySem){
                            
                            if($sheetsName['ENTITAS'][$i] === $keySem){
                                $data[$entitasInd][$sheetsName['ENTITAS'][$i]] = $arrSementara[$keySem];
                                break;
                            }
                            
                            $data[$entitasInd][$sheetsName['ENTITAS'][$i]] = '';
                        }
                    }

                }

            }

            if($key == 'DOKUMEN'){
                foreach($this->inbound->inboundDocuments as $indInboundDocument=>$inboundDocument){
                    $arrSementara = [
                        'NOMOR AJU' => $this->inbound->request_number ?? '',
                        'SERI' => ($indInboundDocument + 1),
                        'KODE DOKUMEN' => $inboundDocument->masterDocument->code,
                        'NOMOR DOKUMEN' => $inboundDocument->details['nomor_dokumen'],
                        'TANGGAL DOKUMEN' => $inboundDocument->details['date'],
                        'KODE FASILITAS' => ' ',
                        'KODE IJIN' => ' '                    
                    ];

                    for($i = 0 ; $i < count($sheetsName['DOKUMEN']) ; $i++){

                        $keySementara = array_keys($arrSementara);
                        foreach($keySementara as $keySem){
                            
                            if($sheetsName['DOKUMEN'][$i] === $keySem){
                                $data[$indInboundDocument][$sheetsName['DOKUMEN'][$i]] = $arrSementara[$keySem];
                                break;
                            }
                            
                            $data[$indInboundDocument][$sheetsName['DOKUMEN'][$i]] = '';
                        }
                    }

                }
            }

            if($key == 'PENGANGKUT'){

                $inboundTransportation = $this->inbound->inboundTransportation;
                foreach($inboundTransportation as $transportationInd=>$transportation){
                    $arrSementara = [
                        'NOMOR AJU' => $this->inbound->request_number ?? '',
                        'SERI' => ($transportationInd + 1),
                        'KODE CARA ANGKUT' => $transportation->transportation->code,
                        'NAMA PENGANGKUT' => $transportation->name,
                        'NOMOR PENGANGKUT' => $transportation->vehicle_number,
                        'KODE BENDERA' => $transportation->country_code,
                        'CALL SIGN' => ' ',
                        'FLAG ANGKUT PLB' => ' '
                    ];

                    for($i = 0 ; $i < count($sheetsName['PENGANGKUT']) ; $i++){

                        $keySementara = array_keys($arrSementara);
                        foreach($keySementara as $keySem){
                            
                            if($sheetsName['PENGANGKUT'][$i] === $keySem){
                                $data[$entitasInd][$sheetsName['PENGANGKUT'][$i]] = $arrSementara[$keySem];
                                break;
                            }
                            
                            $data[$entitasInd][$sheetsName['PENGANGKUT'][$i]] = '';
                        }
                    }

                }

            }

            if($key == 'KEMASAN'){

                foreach($this->inbound->inboundPackages as $packageInd=>$inboundPackage){
                    $masterPackage = MasterPackage::find($inboundPackage->packaging_id);
                    $arrSementara = [
                        'NOMOR AJU' => $this->inbound->request_number ?? '',
                        'SERI' => ($packageInd + 1),
                        'KODE KEMASAN' => $masterPackage->code ?? '',
                        'JUMLAH KEMASAN' => $inboundPackage->details['jumlah_kemasan'] ?? '',
                        'MEREK' => $inboundPackage->details['merek'] ?? ''
                    ];

                    for($i = 0 ; $i < count($sheetsName['KEMASAN']) ; $i++){

                        $keySementara = array_keys($arrSementara);
                        foreach($keySementara as $keySem){
                            
                            if($sheetsName['KEMASAN'][$i] === $keySem){
                                $data[$packageInd][$sheetsName['KEMASAN'][$i]] = $arrSementara[$keySem];
                                break;
                            }
                            
                            $data[$packageInd][$sheetsName['KEMASAN'][$i]] = '';
                        }
                    }

                }

            }

            if($key == 'KONTAINER'){

                foreach($this->inbound->inboundPetiKemas as $inboundPetiKemasInd=>$inboundPetiKemas){

                    $arrSementara = [
                        'NOMOR AJU'             => $this->inbound->request_number ?? '',
                        'SERI'                  => ($inboundPetiKemasInd + 1),
                        'NOMOR KONTINER'        => $inboundPetiKemas->details['nomor_peti_kemas'] ?? '',
                        'KODE UKURAN KONTAINER' => $inboundPetiKemas->details['ukuran_peti_kemas_id'] ?? '',
                        'KODE JENIS KONTAINER'  => $inboundPetiKemas->details['jenis_peti_kemas'] ?? '',
                        'KODE TIPE KONTAINER'   => $inboundPetiKemas->masterTypePetiKemas->code ?? ''
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

               
            }

            if($key == 'BARANG'){
                foreach($this->inbound->inboundDetails as $barandInd=>$inboundDetail){
                    $arrSementara = [
                        'NOMOR AJU' => $this->inbound->request_number ?? '',
                        'SERI BARANG' => $barandInd+1 ?? '',
                        'ASURANSI' => $inboundDetail->details['asuransi'] ?? '0',
                        'CIF' => $inboundDetail->details['nilai_cif'] ?? '0',
                        'CIF RUPIAH' => $inboundDetail->details['cif_rp'] ?? '0',
                        'NDPBM' => $this->inbound->details['ndpbm'],
                        'DISKON' => $inboundDetail->details['biaya_pengurang'] ?? '',
                        'KODE KEMASAN' => $inboundDetail->good->uom->code ?? '',
                        'HARGA PENYERAHAN' => '0',
                        'HARGA PEROLEHAN' => '0',
                        'FOB' => $inboundDetail->details['fob'] ?? '0',
                        'FREIGHT' => $inboundDetail->details['freight'] ?? '0',
                        'HARGA SATUAN' => $inboundDetail->details['fob_unit'] ?? '0', 
                        'HARGA EKSPOR' => '0',
                        'Harga PATOKAN' => '',
                        'NILAI BARANG' => '0',
                        'NILAI JASA' => '0',
                        'JUMLAH KEMASAN' => $inboundDetail->package_details['jumlah'] ?? '',
                        'JUMLAH BAHAN BAKU' => $jumlahbar ?? '',
                        'JUMLAH SATUAN' => $inboundDetail->quantity ?? '',
                        'HS' => $inboundDetail->hsCode->code ?? '',
                        'KODE BARANG' => $inboundDetail->details['kode_barang'] ?? '',
                        'KODE FASILITAS' => $inboundDetail->details['fasilitas'] ?? '',
                        'KODE SATUAN' => $inboundDetail->good->uom->code ?? '',
                        'MERK' => $inboundDetail->details['merk'] ?? '',
                        'NETTO' => $inboundDetail->details['netto'] ?? $inboundDetail->nett_weight,
                        'SPESIFIKASI LAIN' => $inboundDetail->details['spesifikasi_lain'] ?? '',
                        'TIPE' => $inboundDetail->details['type'] ?? '',
                        'UKURAN' => $inboundDetail->details['ukuran'] ?? '',
                        'URAIAN' => $inboundDetail->details['uraian'] ?? '',
                        'VOLUME' => $inboundDetail->volume ?? '',
                        'RATE PREFERENCE' => $inboundDetail->ratePreference->name ?? '',
                        'KODE DAERAH ASAL' => $inboundDetail->details['item_place_of_origin'],
                        'KODE NEGARA ASAL' => $inboundDetail->details['item_country'],

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
           
            if($key == 'BARANGDOKUMEN'){
                // foreach($this->inbound->inboundDocumentsExcel as $barandInd=>$barangdoku){
                //     if($barangdoku->document_id != 104){
                //         $arrSementara = [
                //             'NOMOR AJU' => $this->inbound->request_number ?? '',
                //             'SERI BARANG' => $barangdoku->seri_barang ?? '',
                //             'SERI DOKUMEN' => $barangdoku->seri_document ?? ''
                //         ];
                //     }

                //     for($i = 0 ; $i < count($sheetsName['BARANGDOKUMEN']) ; $i++){

                //         $keySementara = array_keys($arrSementara);
                //         foreach($keySementara as $keySem){
                            
                //             if($sheetsName['BARANGDOKUMEN'][$i] === $keySem){
                //                 $data[$barandInd][$sheetsName['BARANGDOKUMEN'][$i]] = $arrSementara[$keySem];
                //                 break;
                //             }
                            
                //             $data[$barandInd][$sheetsName['BARANGDOKUMEN'][$i]] = '';
                //         }
                //     }
                // }
                
            }
            
            if($key == 'BARANGENTITAS'){
                $arrSementara = [
                    'NOMOR AJU' => ' ',
                    'SERI BARANG' => ' ',
                    'SERI DOKUMEN'  => ' '
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

                foreach($this->inbound->inboundBank as $inboundBankInd=>$inboundBank){
                    $arrSementara = [
                        'NOMOR AJU' => $this->inbound->request_number ?? '',
                        'SERI' => $inboundBank->no_seri,
                        'KODE' => $inboundBank->masterBank->code,
                        'NAMA' => $inboundBank->masterBank->name
                    ];

                    for($i = 0 ; $i < count($sheetsName['BANKDEVISA']) ; $i++){

                        $keySementara = array_keys($arrSementara);
                        foreach($keySementara as $keySem){
                            
                            if($sheetsName['BANKDEVISA'][$i] === $keySem){
                                $data[$packageInd][$sheetsName['BANKDEVISA'][$i]] = $arrSementara[$keySem];
                                break;
                            }
                            
                            $data[$packageInd][$sheetsName['BANKDEVISA'][$i]] = '';
                        }
                    }

                }

            }

            if($key == 'VERSI'){
                $arrSementara = [
                    'VERSI' => '1.1'
                ];

                for($i = 0 ; $i < count($sheetsName['VERSI']) ; $i++){

                    $keySementara = array_keys($arrSementara);
                    foreach($keySementara as $keySem){
                        
                        if($sheetsName['VERSI'][$i] === $keySem){
                            $data[$packageInd][$sheetsName['VERSI'][$i]] = $arrSementara[$keySem];
                            break;
                        }
                        
                        $data[$packageInd][$sheetsName['VERSI'][$i]] = '';
                    }
                }
            }  
            
            foreach($sheetsName[$key] as $it=>$item){
                if(in_array('1', explode(' ', $item)) || in_array('2', explode(' ', $item))){
                    $sheetsName[$key][$it] = preg_replace('/[0-9]+/', '', $item);
                }
            }

            $sheets[] = new PerSheetBC20Export($key, $sheetsName[$key], $data);
        } 
        return $sheets;
    }   
}

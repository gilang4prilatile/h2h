<?php

namespace App\Imports;

use App\Models\Inbound;
use App\Models\InboundDocument;
use App\Models\City;
use App\Models\MasterKppbc;
use App\Models\Port;
use App\Models\MasterValas;
use App\Models\MasterTPS;
use App\Models\MasterIncoterm;
use DB;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Log;

class HeaderSheetImport implements ToModel, WithHeadingRow
{
    protected $bc;
    protected $nomorPengajuan;
    protected $userId;
    public $id;  // To hold the inserted ID

    public function __construct($bc, $nomorPengajuan, $userId)
    {
        $this->bc = $bc;
        $this->nomorPengajuan = $nomorPengajuan;
        $this->userId = $userId;
    }

    public function model(array $row)
    {
        // Default statuses
        $statusbc = 0;
        $statusform = 0;

        if ($row['kode_dokumen'] == 20) {
            $statusbc = 6;
            $statusform = 11;
        }else {
            $statusbc = 7;
            $statusform = 13;
        }

        // Find the necessary models and validate them
        $City = City::where('city', '=', $row['kota_pernyataan'])->first();

        $MasterKppbc = MasterKppbc::where('code', '=', $row['kode_kantor'])->first();
        $valas = MasterValas::where('code', '=', $row['kode_valuta'])->first();
        $tps = MasterTPS::where('code_warehouse', '=', $row['kode_tps'])->first();
        $incoterm = MasterIncoterm::where('code', '=', $row['kode_incoterm'])->first();
        
        // Validate required data
        if (!$City) {
            Log::error('City tidak ditemukan untuk kota: ' . $row['kota_pernyataan']);
            return;
        }
        if (!$MasterKppbc) {
            Log::error('KPPBC tidak ditemukan untuk kode: ' . $row['kode_kantor']);
            return;
        }
        if (!$valas) {
            Log::error('Valas tidak ditemukan untuk kode: ' . $row['kode_valuta']);
            return;
        }
        if (!$tps) {
            Log::error('TPS tidak ditemukan untuk kode: ' . $row['kode_tps']);
            return;
        }
        if (!$incoterm) {
            Log::error('Incoterm tidak ditemukan untuk kode: ' . $row['kode_incoterm']);
            return;
        }

        // Handling ports
        $kode_pelabuhan_muat = !empty($row['kode_pelabuhan_muat']) ? Port::where('code', '=', $row['kode_pelabuhan_muat'])->first() : null;
        $kode_pelabuhan_transit = !empty($row['kode_pelabuhan_transit']) ? Port::where('code', '=', $row['kode_pelabuhan_transit'])->first() : null;
        $kode_pelabuhan_tujuan = !empty($row['kode_pelabuhan_tujuan']) ? Port::where('code', '=', $row['kode_pelabuhan_tujuan'])->first() : null;
        $kode_pelabuhan_bongkar = !empty($row['kode_pelabuhan_bongkar']) ? Port::where('code', '=', $row['kode_pelabuhan_bongkar'])->first() : null;
        $kode_pelabuhan_ekspor = !empty($row['kode_pelabuhan_ekspor']) ? Port::where('code', '=', $row['kode_pelabuhan_ekspor'])->first() : null;
        
        DB::beginTransaction();

        try { 

            $ndpbm = !empty($row['ndpbm']) && $row['ndpbm'] != 0 ? $row['ndpbm'] : 0;
 
            $cif_hitung      = !empty($row['cif']) && $row['cif'] != 0 ? $row['cif'] * $ndpbm : $row['cif'];
            $freight_hitung  = !empty($row['freight']) && $row['freight'] != 0 ? $row['freight'] * $ndpbm : $row['freight'];
            $asuransi_hitung = !empty($row['asuransi']) && $row['asuransi'] != 0 ? $row['asuransi'] * $ndpbm : $row['asuransi'];
            $biaya_penambah  = !empty($row['biaya_penambah']) ? $row['biaya_penambah'] : 0;
            $biaya_pengurang = !empty($row['biaya_pengurang']) ? $row['biaya_pengurang'] : 0;

            $diskon_hitung = ($biaya_penambah - $biaya_pengurang) * $ndpbm;

            $cif_rp = $cif_hitung + $freight_hitung + $asuransi_hitung + $diskon_hitung;

            $details = [
                "nomor_pendaftaran" => $row['nomor_daftar'] ?? $this->nomorPengajuan,
                "tanggal_pendaftaran" => $row['tanggal_daftar'] ??  date('d-m-Y'),
                "nomor_tutup_pu" => (string)$row['kode_tutup_pu'],  
                "estimated_arrival_date" => (string)$row['tanggal_tiba'],  
                "ndpbm" => (string)$row['ndpbm'],  
                "jenis_transaksi_id" => (string)$row['kode_jenis_nilai'],  
                "hincoterm_id" => (string)$incoterm->id,  
                "fob" => !empty($row['fob']) ? (string)$row['fob'] : (string)$row['cif'],  
                "cif" => (string)$row['cif'],
                "cif_rp" => (string)$cif_rp,  
                "biaya_penambah" => (string)$row['biaya_tambahan'],  
                "biaya_pengurang" => (string)$row['biaya_pengurang'],  
                "freight" => (string)$row['freight'],  
                "asuransi" => (string)$row['asuransi'],  
                "type_asuransi" => $row['kode_asuransi'] == "LN" ? "2" : "1",  
                "voluntary_declaration" => (string)$row['vd'],  
                "berat_kotor" => (string)$row['bruto'],  
                "berat_bersih" => (string)$row['netto'],  
                "pabean_tanggal" => (string)$row['tanggal_pernyataan'],  
                "pabean_pemberitahu" => (string)$row['nama_pernyataan'],  
                "pabean_jabatan" => (string)$row['jabatan_pernyataan'],  
            ];

            //$details_json = json_encode($details);
            //if (json_last_error() !== JSON_ERROR_NONE) {
            //   throw new \Exception('JSON tidak valid: ' . json_last_error_msg());
            //}

            $inbound = Inbound::create([
                'bc_form_id' => $statusbc,
                'status_id' => $statusform,
                'intangible_status' => $row['barang_tidak_berwujud'] ?? 0,
                'request_number' => $this->nomorPengajuan,
                'details' => $details,
                'partial' => 0,
                'faktur_pajak' => 0,
                'pib_type_id' => $row['kode_jenis_prosedur'],
                'payment_type_id' => $row['kode_cara_bayar'],
                'import_type_id' => $row['kode_jenis_impor'],
                'export_loading_port_id' => 0,
                'city_id' => $City->id,
                'bruto' => $row['bruto'],
                'netto' => $row['netto'],
                'created_by' => $this->userId,
            ]);

            if (!$inbound) {
                throw new \Exception('Gagal melakukan insert ke tabel Inbound');
            }

            $this->id = $inbound->id;

            // Inbound Transportation
            $inboundTransportation = $inbound->inboundTransportation()->create([
                "transportation_id" => 9, "vehicle_number" => 1, "country_code" => "-", "name" => "-"
            ]);

            // Insert Ports  
            $ports = [];
            if ($kode_pelabuhan_tujuan) {
                $ports[] = [
                    "inbound_transportation_id" => $inboundTransportation->id, 
                    "port_id" => $kode_pelabuhan_tujuan->id, 
                    "type" => "tujuan"
                ];
            }
            if ($kode_pelabuhan_muat) {
                $ports[] = [
                    "inbound_transportation_id" => $inboundTransportation->id, 
                    "port_id" => $kode_pelabuhan_muat->id, 
                    "type" => "muat"
                ];
            }
            if ($kode_pelabuhan_transit) {
                $ports[] = [
                    "inbound_transportation_id" => $inboundTransportation->id, 
                    "port_id" => $kode_pelabuhan_transit->id, 
                    "type" => "transit"
                ];
            }
            if ($kode_pelabuhan_bongkar) {
                $ports[] = [
                    "inbound_transportation_id" => $inboundTransportation->id, 
                    "port_id" => $kode_pelabuhan_bongkar->id, 
                    "type" => "bongkar"
                ];
            }

            // Periksa apakah data port ada untuk dimasukkan
            if (count($ports) > 0) {
                try {
                    $inboundTransportation->transportationPorts()->insert($ports);
                } catch (\Exception $e) {
                    // Tangani jika insert gagal
                    Log::error('Gagal memasukkan ports: ' . $e->getMessage());
                }
            }


            // Insert related data
            $inbound->inboundKppbcPengawas()->create(["kppbc_id" => $MasterKppbc->id, "type" => "pengawas"]);
            $inbound->inboundValas()->create(["valas_id" => $valas->id]);
            $inbound->inboundTPS()->create(["master_tps_id" => $tps->id]);

            // Inbound document creation
            InboundDocument::create([
                'document_id'       => '104',
                'inbound_id'        => $inbound->id, 
                'seri_document'     => 0,
                'seri_barang'       => 0,
                'details'           => [
                    "nomor_dokumen"             => $row['nomor_bc11'],
                    "date"                      => $row['tanggal_bc11'],                    
                    "nomor_pos_dokumen"         => $row['nomor_pos'],
                    "nomor_sub_pos_dokumen"     => $row['nomor_sub_pos'] ?? "0000",
                    "nomor_sub_sub_pos_dokumen" => $row['nomor_sub_pos'],
                ],
                'created_by' => $this->userId
            ]);

            DB::commit();
            Log::info('Inbound berhasil di-insert dengan ID: ' . $inbound->id .'-'.$this->nomorPengajuan);

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Gagal melakukan insert: ' . $e->getMessage());
            return;
        } 
        return $inbound;
    }
}

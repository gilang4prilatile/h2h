<?php
namespace App\Imports;

use App\Models\InboundDetail;
use App\Models\Good; 
use App\Models\MasterUom;
use App\Models\MasterPackage; 
use App\Models\Country; 
use App\Models\HsCode; 
use App\Helpers\ComboHelper;
use App\Models\Inbound;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Throwable;
use DB; 

class GoodSheetImport implements ToModel, WithHeadingRow
{
    protected $idInbound;
    protected $userId;
    protected $helper;

    public function __construct($idInbound, $userId)
    {
        $this->idInbound = $idInbound;
        $this->userId = $userId;
        $this->helper = new ComboHelper();
    }

    public function model(array $row)
    {  
 
        $Inbound    = Inbound::where('request_number', $this->idInbound)->first(); 
        $uom        = MasterUom::firstOrCreate(['code' => $row['kode_satuan']]);  
        $kemasan    = MasterPackage::firstOrCreate(['code' => $row['kode_kemasan']]); 
        $HsCode     = HsCode::firstOrCreate(
            ['code' => $row['hs']],
            ['type' => 'sub-pos-asean']
        );
        
        // Cek jika HsCode->details adalah string, lalu decode
        $details = is_string($HsCode->details) ? json_decode($HsCode->details, true) : $HsCode->details;
        
        // Jika $details null atau bukan array, set ke array kosong
        $details = is_array($details) ? $details : [];
        
        // Lakukan pengecekan untuk update details
        if (($HsCode->type === 'sub-pos-asean' || empty($HsCode->type)) &&
            (
                (isset($details['description_id']) && $details['description_id'] === $row['hs']) || 
                empty($details['description_id']) || 
                (isset($details['description_eng']) && $details['description_eng'] === $row['hs']) || 
                empty($details['description_eng'])
            )
        ) {
            $details = array_merge($details, [
                'bk' => null,
                'bm' => null,
                'ppn' => null,
                'note' => null,
                'bm_ad' => null,
                'bm_im' => null,
                'bm_tp' => null,
                'cukai' => null,
                'ppnbm' => null,
                'pph_api' => null,
                'pph_non_api' => null,
                'status_lantas' => '0',
                'description_id' => $row['hs'], 
                'description_eng' => $row['hs'],  
            ]);
        
            // Simpan details yang sudah di-update
            $HsCode->type    = 'sub-pos-asean';
            $HsCode->details = $details;
            $HsCode->save();
        }
         
            $good       = $this->getOrCreateGood($row, $uom->id);  
            DB::beginTransaction();
            try {	
                $inboundDetail = InboundDetail::updateOrCreate(
                    [
                        'inbound_id' => $Inbound->id,
                        'no_seri' => $row['seri_barang'],
                    ],
                    [
                        'good_id' => $good->id,
                        'hs_code_id' => $HsCode->id ?? 4,
                        'package_id' => $kemasan->id,
                        'quantity' => $row['jumlah_satuan'] ?? 0,
                        'bruto' => $row['bruto'] ?? 0,
                        'nett_weight' => $row['netto'] ?? 0,
                        'volume' => $row['volume'] ?? 0,
                        'lartas' => $row['pertanyaan_lartas'] ?? 0,
                        'package_details' => ['jumlah' => (string)$row["jumlah_kemasan"]],
                        'details' => [
                            "kode_barang" => $row["kode_barang"],
                            "spesifikasi_lain" => $row["spesifikasi_lain"] ?? "-",
                            "merk" => $row["merek"] ?? "-",
                            "type" => $row["tipe"] ?? "-",
                            "ukuran" => $row["ukuran"] ?? "-",
                            "uraian" => $row["uraian"] ?? "-",
                            "item_condition" => $row['item_condition'] ?? 1,//$this->helper->getKondisiBarangExel($row['item_condition'] ?? ""),
                            "item_country" => $row['kode_negara_asal'],
                            "uom_id" => (string)$uom->id,
                            "harga_barang" => (string)$row["cif"],
                            "harga_satuan" => (string)$row["harga_satuan"],
                            "biaya_penambah_diskon" => (string)$row["diskon"],
                            "fob" => (string)$row["fob"],
                            "freight" => (string)$row["freight"],
                            "asuransi" => (string)$row["asuransi"],
                            "cif" => (string)$row["cif"],
                            "cif_rp" => (string)$row["cif_rupiah"],
                        ],
                        'created_by' => $this->userId,
                    ]
                );
                DB::commit();
                Log::info('Inbound GoodSheetImport berhasil di-insert dengan GoodSheetImport ID: ' . $Inbound->id);

            } catch (\Exception $e) {
                DB::rollBack();
                Log::error('Gagal melakukan insert: GoodSheetImport' . $e->getMessage());
                return;
            } 
            return $inboundDetail;
      
    }

    private function getOrCreateGood(array $row, $uom)
    {
        return Good::firstOrCreate(
            ['kode_barang' => $row['kode_barang']],
            [
                'name' => $row['nama_barang'] ?? $row['kode_barang'],
                'nett_weight' => $row['netto'], 
                'volume' => $row['volume'] ?? 0,
                'amount' => 0,
                'uom_id' => $uom,
                'details' => [
                    "kode_barang" => $row['nama_barang'] ?? $row['kode_barang'],
                    "merk" => $row["merek"],
                    "type" => $row["tipe"],
                    "ukuran" => $row["ukuran"],
                    "uraian" => $row["uraian"],
                    "spesifikasi_lain" => $row["spesifikasi_lain"]
                ],
                'created_by' => $this->userId,
            ]
        );
    }
}

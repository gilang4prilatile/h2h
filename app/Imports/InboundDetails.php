<?php
namespace App\Imports;


use App\Models\InboundDetail;
use App\Models\Good; 
use App\Models\Inbound;
use App\Models\MasterUom;
use App\Models\MasterPackage; 
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Throwable;
use Illuminate\Support\Facades\Log; 

class InboundDetails implements ToModel, WithHeadingRow
{
    protected $idInbound;
    protected $userId;
    

    public function __construct($idInbound, $userId)
    {
    
        $this->idInbound = $idInbound;
        $this->userId = $userId;
        
    }

    public function model(array $row)
    { 
        try {  
            
            $uom     = MasterUom::firstOrCreate(['code' => $row['kode_satuan']]);
            $kemasan = MasterPackage::firstOrCreate(['code' => $row['kode_kemasan']]);
            $good    = $this->getOrCreateGood($row,$uom->id);  
            $inboundDetail  =  new InboundDetail([
                'inbound_id'        => $this->idInbound,
                'good_id'           => $good->id,
                'hs_code_id'        => $row['hs_code'] ?? 4,
                'package_id'        => $kemasan->id, 
                'package_details'   => ["jumlah"=> $row["jumlah_kemasan"]],
                'quantity'          => $row['amount'], 
                'bruto'             => $row['bruto'],
                'nett_weight'       => $row['netto'], 
                'volume'            => $row['volume'], 
                "details"           => [
                    "kode_barang"       => $row["kode_barang"],
                    "spesifikasi_lain"  => $row["spesifikasi_lain"],
                    "merk"              => $row["merek"],
                    "type"              => $row["tipe"],
                    "ukuran"            => $row["ukuran"],
                    "uraian"            => $row["uraian"],
                    "item_condition"    => $row["kode_kondisi_barang"],
                    "item_country"      => $row["kode_negara_asal"],
                    "harga_barang"      => $row["kode_barang"],
                    "harga_satuan"      => $row["harga_satuan"],
                    "uom_id"            => $uom->id
                ],
                'created_by'        => $this->userId, 
            ]);
            //print_r($inboundDetail); die();
            $inboundDetail->save();

            
            return $inboundDetail;
        } catch (Throwable $e) {
           
            Log::error($e->getMessage());

            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
 
    private function getOrCreateGood(array $row, $uom)
    {
        $good = Good::where('kode_barang', $row['kode_barang'])->first(); 
        if (!$good) {
            $good = new Good([
                'kode_barang'       => $row['kode_barang'],
                'name'              => $row['nama_barang'] ?? $row['kode_barang'],
                'nett_weight'       => $row['netto'], 
                'volume'            => $row['volume'],
                'amount'            => $row['amount'],
                'uom_id'            => $uom,
                "details"           => [
                    "merk"              => $row["merek"],
                    "type"              => $row["tipe"],
                    "ukuran"            => $row["ukuran"],
                    "uraian"            => $row["uraian"],
                    "kode_barang"       => $row["kode_barang"],
                    "spesifikasi_lain"  => $row["spesifikasi_lain"]
                ],
                'created_by'        => $this->userId,
            ]); 
            $good->save();
        } 
        return $good;
    }

    /*

        $entityProfile->name    = strtoupper($filteredInput->get($entity . '_nama'));
        $entityProfile->address = strtoupper($filteredInput->get($entity . '_alamat')); 
        $entityProfile->types   = $entityType;
        $entityProfile->details = $entityDataDetail;
        
        $entityProfile->save();
        $profileId  = $entityProfile->id;

        auth()->user()->id;
        print_r($row); die();
        inbound_id
        good_id
        hs_code_id
        package_id
        package_details
        quantity
        nett_weight
        volume
        amount
        details
        created_at
        updated_at
        
        $return  =  new InboundDetail([
            'hs_code'    => $row['hs_code'],
            'kode_barang'  => $row['kode_barang'],
            'nama_barang'  => $row['nama_barang'],
            'uraian'  => $row['uraian'],
            'merek'  => $row['merek'],
            'tipe'  => $row['tipe'],
            'ukuran'  => $row['ukuran'],
            'spesifikasi_lain'  => $row['spesifikasi_lain'],
            'kode_satuan'  => $row['kode_satuan'],
            'jumlah_satuan'  => $row['jumlah_satuan'],
            'kode_kemasan'  => $row['kode_kemasan'],
            'jumlah_kemasan'  => $row['jumlah_kemasan'],
            'netto'  => $row['netto'],
            'bruto'  => $row['bruto'],
            'harga_satuan'  => $row['harga_satuan'],
            'kode_kondisi_barang'  => $row['kode_kondisi_barang'],
            'kode_negara_asal'  => $row['kode_negara_asal'], 
        ]);
        */ 
}

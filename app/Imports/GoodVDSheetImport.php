<?php
namespace App\Imports;
use App\Models\InboundDetailVd;
use App\Models\InboundDetail;
use App\Models\Inbound;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use DB;
use Log;

class GoodVDSheetImport implements ToModel, WithHeadingRow
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
        $Inbound = Inbound::where('request_number', $this->idInbound)->first();
    
        // Cek apakah $Inbound berhasil ditemukan
        if (!$Inbound) {
            Log::error('Inbound tidak ditemukan untuk request_number: ' . $this->idInbound);
            return null; // Kembalikan null jika Inbound tidak ditemukan
        }

        // Cari detail barang berdasarkan no_seri 
        $inboundDetail = InboundDetail::where('inbound_id', $Inbound->id)
        ->where('no_seri', (int)$row['seri_barang'])
        ->first();
        
        // Cek apakah $inboundDetail berhasil ditemukan
        if (!$inboundDetail) {
            Log::error('InboundDetail tidak ditemukan untuk Inbound ID: ' . $Inbound->id . ' dan no_seri: ' . $row['seri_barang']);
            return null; // Kembalikan null jika inboundDetail tidak ditemukan
        }
        DB::beginTransaction();

        try {	
            $barangVD = InboundDetailVd::create([
                'inbound_id'         => $Inbound->id,
                'inbound_detail_id'  => $inboundDetail ? $inboundDetail->id : null, 
                'seri_barang'        => $row['seri_barang'],
                'details' => [
                        "jenis_transaksi"       => $row['kode_vd'],
                        "jatuh_tempo_royalti"   => $row['jatuh_tempo'] ?? "-",
                        "nilai_barang_vd"       => (string)$row['nilai_barang'] ?? 0, 
                        "additional_cost"       => (string)$row['biaya_tambahan'] ?? 0, 
                        "reduced_cost"          => (string)$row['biaya_pengurang'] ?? 0, 
                        
                ],   
                'created_by'      => $this->userId, // ID pengguna yang login
            ]);
        DB::commit();
        Log::info('Inbound GoodVDSheetImport berhasil di-insert dengan GoodVDSheetImport ID: ' . $Inbound->id);

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Gagal melakukan insert: GoodVDSheetImport' . $e->getMessage());
            return;
        } 

        return $barangVD;
    }

} 
<?php
namespace App\Imports;
use App\Models\Inbound;
use App\Models\InboundDocument;
use App\Models\InboundDetail; // Relasi dengan barang
use App\Models\MasterDocument;
use App\Models\MasterFasilitas;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use DB;
use Log;

class DocumentGoodSheetImport implements ToModel, WithHeadingRow
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
        if (!$Inbound) {
            Log::error("Inbound tidak ditemukan untuk Nomor Aju: " . $this->idInbound);
            return null;  
        }
 
        $inboundDetail = InboundDetail::where('inbound_id', $Inbound->id)
            ->where('no_seri', $row['seri_barang']) 
            ->first();
 
        $existingDocument = InboundDocument::where('inbound_id', $Inbound->id)
            ->where('seri_document', $row['seri_dokumen'])  
            ->first();
 
        $tanggalDokumen = $existingDocument && isset($existingDocument->details['date']) 
            ? $existingDocument->details['date'] 
            : ($existingDocument->details['date']  ?? null);  

        $nomorDokumen = $existingDocument && isset($existingDocument->details['nomor_dokumen']) 
            ? $existingDocument->details['nomor_dokumen'] 
            : ($existingDocument->details['nomor_dokumen'] ?? null); 

        $idFasilitas = $existingDocument && $existingDocument->id_fasilitas 
            ? $existingDocument->id_fasilitas 
            : ($existingDocument->id_fasilitas  ?? null);  

        $idInstitutionalPermission = $existingDocument && $existingDocument->id_institutional_permission 
            ? $existingDocument->id_institutional_permission 
            : ($existingDocument->id_institutional_permission ?? null); 

        DB::beginTransaction();

        try {    
            if ($existingDocument) { 
                // Jika dokumen sudah ada, update
                $existingDocument->update([
                    'inbound_detail_id'  => $inboundDetail ? $inboundDetail->id : null,  
                    'seri_barang'        => $row['seri_barang'],  
                    'seri_document'      => $row['seri_dokumen'], 
                    'details'            => 
                    [
                        "date"           => (string)$tanggalDokumen,  
                        "nomor_dokumen"  => (string)$nomorDokumen, 
                    ],
                    'id_fasilitas'                  => $idFasilitas, 
                    'id_institutional_permission'   => $idInstitutionalPermission,  
                ]);
            } else { 
                // Insert dokumen baru
                InboundDocument::create([
                    'inbound_id'         => $Inbound->id,
                    'inbound_detail_id'  => $inboundDetail ? $inboundDetail->id : null,  
                    'seri_document'      => $row['seri_dokumen'],  
                    'seri_barang'        => $row['seri_barang'],  
                    'details'            => 
                    [
                        "date"           => (string)$tanggalDokumen,  
                        "nomor_dokumen"  => (string)$nomorDokumen, 
                    ],
                    'id_fasilitas'                  => $idFasilitas, 
                    'id_institutional_permission'   => $idInstitutionalPermission,  
                    'created_by'                    => $this->userId,
                ]);
            }
            DB::commit();
            Log::info('Inbound DocumentGoodSheetImport berhasil di-insert dengan DocumentGoodSheetImport ID: ' . $Inbound->id);

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Gagal melakukan insert: DocumentGoodSheetImport ' . $e->getMessage());
            return null; 
        }

        return null; // Pastikan mengembalikan null untuk fungsi ini
    }


}

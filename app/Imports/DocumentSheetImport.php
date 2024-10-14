<?php
namespace App\Imports;
use App\Models\Inbound;
use App\Models\InboundDocument;
use App\Models\MasterDocument;
use App\Models\MasterFasilitas;
use App\Models\MasterInstitutionalPermission;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use DB;
use Log;

class DocumentSheetImport implements ToModel, WithHeadingRow
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
        $Inbound                = Inbound::where('request_number', $this->idInbound)->first();
        $MasterDocument         = MasterDocument::where('code' , '=',  $row['kode_dokumen'])->first();
        $MasterFasilitas        = MasterFasilitas::where('code' , '=',  $row['kode_fasilitas'])->first();
        $MasterInstitutionalPermission   = MasterInstitutionalPermission::where('code' , '=',  $row['kode_ijin'])->first();
        
        DB::beginTransaction();

        try {
            $dokumen = InboundDocument::create([
                'inbound_id'                    => $Inbound->id,
                'document_id'                   => $MasterDocument->id,
                'seri_document'                 => $row['seri'],
                'details' => [
                        "date"                  => (string)$row['tanggal_dokumen'],
                        "nomor_dokumen"         => (string)$row['nomor_dokumen'], 
                ],    
                'id_fasilitas'                  => $MasterFasilitas->id ?? null,
                'id_institutional_permission'   => $MasterInstitutionalPermission->id ?? null,
                'created_by'                    => $this->userId, 
            ]);
            DB::commit();
            Log::info('Inbound DocumentSheetImport berhasil di-insert dengan DocumentSheetImport ID: ' . $Inbound->id);

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Gagal melakukan insert: DocumentSheetImport' . $e->getMessage());
            return;
        } 
    
        return $dokumen;
    }
}

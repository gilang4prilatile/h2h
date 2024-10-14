<?php
namespace App\Imports;
use App\Helpers\ComboHelper;
use App\Models\Inbound;
use App\Models\InboundPetiKemas;
use App\Models\MasterTypePetiKemas;
use App\Models\MasterUkuranPetiKemas;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use DB;
use Log;

class ContainerSheetImport implements ToModel, WithHeadingRow
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
        $Inbound                 = Inbound::where('request_number', $this->idInbound)->first(); 
        $MasterTypePetiKemas     = MasterTypePetiKemas::where('code' , '=',  $row['kode_tipe_kontainer'])->first();
        $MasterUkuranPetiKemas   = MasterUkuranPetiKemas::where('code' , '=',  $row['kode_ukuran_kontainer'])->first();
        DB::beginTransaction();

        try {	
            $kontainer = InboundPetiKemas::create([
                'inbound_id'            => $Inbound->id,
                'container_id'          => $MasterTypePetiKemas->id,
                'no_seri'                => $row['seri'],
                'details' => [
                        "nomor_peti_kemas"      => $row['nomor_kontiner'],
                        "ukuran_peti_kemas_id"  => $MasterUkuranPetiKemas->id,
                        "jenis_peti_kemas"      => $row['kode_jenis_kontainer'] ?? 4,
                ],                
                'created_by'            => $this->userId, // ID pengguna yang login
            ]);
            DB::commit();
            Log::info('Inbound ContainerSheetImport berhasil di-insert dengan ContainerSheetImport ID: ' . $Inbound->id);

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Gagal melakukan insert: ContainerSheetImport' . $e->getMessage());
            return;
        } 
        return $kontainer;
    }
    
}

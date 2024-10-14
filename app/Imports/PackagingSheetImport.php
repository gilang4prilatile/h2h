<?php
namespace App\Imports;
use App\Models\InboundPackaging;
use App\Models\MasterPackage;
use App\Models\Inbound;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use DB;
use Log;

class PackagingSheetImport implements ToModel, WithHeadingRow
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
        $Inbound           = Inbound::where('request_number', $this->idInbound)->first(); 
        $MasterPackage     = MasterPackage::where('code' , '=',  $row['kode_kemasan'])->first();
        DB::beginTransaction();

        try {
            $kemasan           = InboundPackaging::create([
                'inbound_id'     => $Inbound->id,
                'no_seri'        => $row['seri'],
                'packaging_id'   => $MasterPackage->id,
                'details' => [
                        "jumlah_kemasan" => (string)$row['jumlah_kemasan'],
                        "merek"          => (string)$row['merek'], 
                ],
                'created_by'     => $this->userId,
            ]);

            DB::commit();
            Log::info('Inbound PackagingSheetImport berhasil di-insert dengan PackagingSheetImport ID: ' . $Inbound->id);

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Gagal melakukan insert: PackagingSheetImport' . $e->getMessage());
            return;
        } 
        return $kemasan;
    }
}

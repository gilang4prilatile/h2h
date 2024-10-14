<?php
namespace App\Imports;

use App\Models\InboundDetail;
use App\Models\Inbound;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use DB;
use Log;

class TariffGoodSheetImport implements ToModel, WithHeadingRow
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
        $Inbound       = Inbound::where('request_number', $this->idInbound)->first(); 
        $inboundDetail = InboundDetail::where('inbound_id', $Inbound->id)
                            ->where('no_seri', $row['seri_barang'])
                            ->first();
        DB::beginTransaction();

        try {
            if ($inboundDetail) {
                $details = $inboundDetail->details ?? [];

                // Update detail sesuai dengan kode pungutan
                switch (strtoupper($row['kode_pungutan'])) {
                    case 'BM':
                        $details['bm_type'] = $row['kode_fasilitas'] ?? '';
                        $details['bm'] = $row['tarif'] ?? 0;
                        $details['bm_tax_type'] = $row['kode_tarif'] ?? '';
                        $details['bm_tax_value'] = $row['tarif_fasilitas'] ?? 0;
                        break;
                    case 'PPN':
                        $details['ppn'] = $row['tarif'] ?? 0;
                        $details['ppn_tax_type'] = $row['kode_fasilitas'] ?? '';
                        $details['ppn_tax_value'] = $row['tarif_fasilitas'] ?? 0;
                        break;
                    case 'PPH':
                        $details['pph'] = $row['tarif'] ?? 0;
                        $details['pph_tax_type'] = $row['kode_fasilitas'] ?? '';
                        $details['pph_tax_value'] = $row['tarif_fasilitas'] ?? 0;
                        break;
                    case 'PPNBM':
                        $details['ppnbm'] = $row['tarif'] ?? 0;
                        $details['ppnbm_tax_type'] = $row['kode_fasilitas'] ?? '';
                        $details['ppnbm_tax_value'] = $row['tarif_fasilitas'] ?? 0;
                        break;
                }

                $inboundDetail->details = $details;
                $inboundDetail->save();
            }
            DB::commit();
            Log::info('Inbound TariffGoodSheetImport berhasil di-insert dengan TariffGoodSheetImport ID: ' . $Inbound->id);

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Gagal melakukan insert: TariffGoodSheetImport' . $e->getMessage());
            return;
        } 
        return $inboundDetail;
    }
}

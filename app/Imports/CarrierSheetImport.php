<?php
namespace App\Imports;
use App\Models\InboundTransportation;
use App\Models\InboundTransportationPort;
use App\Models\Country;
use App\Models\Inbound;
use App\Models\Transportation;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use DB;
use Log;

class CarrierSheetImport implements ToModel, WithHeadingRow
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
        $Inbound            = Inbound::where('request_number', $this->idInbound)->first();  
        $Transportation     = Transportation::where('code', '=', $row['kode_cara_angkut'])->first();
 
        if (empty($row['kode_cara_angkut']) || empty($row['nama_pengangkut']) || empty($row['nomor_pengangkut'])) {
            //Log::warning('Data tidak lengkap, tidak melakukan insert. Row: ' . json_encode($row));
            return null;  
        }

        DB::beginTransaction();
        try {
            $pengangkut = InboundTransportation::create([
                'inbound_id'        => $Inbound->id,
                'no_seri'           => $row['seri'],
                'transportation_id' => $Transportation ? $Transportation->id : null,
                'name'              => $row['nama_pengangkut'],
                'vehicle_number'    => $row['nomor_pengangkut'],
                'country_code'      => $row['kode_bendera'],  
                'created_by'        => $this->userId,  
            ]);

            DB::commit();
            Log::info('Inbound CarrierSheetImport berhasil di-insert dengan CarrierSheetImport ID: ' . $Inbound->id);
 
            $existingCarrier = InboundTransportation::where('inbound_id', $Inbound->id)
                ->where('transportation_id', 9)
                ->where('name', '-')
                ->where('vehicle_number', '1')
                ->first();
 
            if ($existingCarrier) {
                InboundTransportationPort::where('inbound_transportation_id', $existingCarrier->id)->update([
                    'inbound_transportation_id' => $pengangkut->id
                ]);
            } 

            InboundTransportation::where('inbound_id', $Inbound->id)
            ->where('transportation_id', 9)
            ->where('name', '-')
            ->where('vehicle_number', '1')
            ->delete();

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Gagal melakukan insert: CarrierSheetImport ' . $e->getMessage());
            return;
        }

        return $pengangkut;
    }


}

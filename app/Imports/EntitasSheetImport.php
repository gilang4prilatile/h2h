<?php
namespace App\Imports;

use App\Helpers\ComboHelper;
use App\Models\Profile;
use App\Models\Inbound;
use App\Models\InboundProfile;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use DB;
use Log;

class EntitasSheetImport implements ToModel, WithHeadingRow
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
        $profile = Profile::where('name', $row['nama_entitas'] ?? null)->first();
        $Inbound = Inbound::where('request_number', $this->idInbound)->first();
        
        $newType = $this->helper->getEntityTypeExel($row['kode_entitas'] ?? 0)[0];

        $newDetails = [
            'tipe_identitas' => $this->helper->getJenisIdentitasExel($row['kode_jenis_identitas'] ?? 0),
            'nomor_identitas'=> $row['nomor_identitas'] ?? '',
            'nomor_api'      => $row['nib_entitas'] ?? '',
            'tipe_api'       => $this->helper->getJenisApiExel($row['kode_jenis_api'] ?? ''),
            'nomor_izin'     => $row['nomor_ijin_entitas'] ?? '',
            'tanggal_ppjk'   => $row['tanggal_ijin_entitas'] ?? '',
            'status'         => $this->helper->getStatusImportirExel($row['kode_status'] ?? ''),
            'niper'          => $row['niper_entitas'] ?? ''
        ];

        DB::beginTransaction();

        try {
            if ($profile) {
                // Periksa apakah details sudah berupa array
                $existingDetails = is_array($profile->details) ? $profile->details : json_decode($profile->details, true);

                if ($existingDetails['nomor_identitas'] != $row['nomor_identitas']) {
                    Log::info('di-insert profile ID: ' . $Inbound->id);
                    $profile = Profile::create([
                        'name'        => $row['nama_entitas'] ?? '',
                        'address'     => $row['alamat_entitas'] ?? '',
                        'types'       => $this->helper->getEntityTypeExel($row['kode_entitas'] ?? 0),
                        'details'     => $newDetails,
                        'country_id'  => $row['kode_negara'] ?? '',
                        'created_by'  => $this->userId,
                    ]);
                } else {
                    $existingTypes = is_array($profile->types) ? $profile->types : json_decode($profile->types, true);
                    if (!in_array($newType, $existingTypes)) {
                        $existingTypes[] = $newType;
                    }
                    
                    $existingDetails = is_array($profile->details) ? $profile->details : json_decode($profile->details, true);
                    $updatedDetails = array_merge($existingDetails, array_filter($newDetails, function ($value, $key) use ($existingDetails) {
                        return empty($existingDetails[$key]) && !empty($value);
                    }, ARRAY_FILTER_USE_BOTH));
                    
                    $profile->update([
                        'types'   => $existingTypes,
                        'details' => $updatedDetails,
                    ]);
                    
                    Log::info('di-update profile ID: ' . $Inbound->id);
                }
            } else {
                Log::info('di-insert profile ID: ' . $Inbound->id);
                $profile = Profile::create([
                    'name'        => $row['nama_entitas'] ?? '',
                    'address'     => $row['alamat_entitas'] ?? '',
                    'types'       => $this->helper->getEntityTypeExel($row['kode_entitas'] ?? 0),
                    'details'     => $newDetails,
                    'country_id'  => $row['kode_negara'] ?? '',
                    'created_by'  => $this->userId,
                ]);
            }

            InboundProfile::create([
                'inbound_id'   => $Inbound->id,
                'profile_id'   => $profile->id,
                'type'         => $newType,
                'created_by'   => $this->userId,
            ]);

            DB::commit();
            Log::info('Inbound EntitasSheetImport berhasil di-insert dengan EntitasSheetImport ID: ' . $Inbound->id);

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Gagal melakukan insert: EntitasSheetImport ' . $e->getMessage());
            return;
        }
        return $profile;
    }
}

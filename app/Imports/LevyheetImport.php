<?php
namespace App\Imports;

use App\Models\Inbound;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use DB;
use Log;

class LevyheetImport implements ToModel, WithHeadingRow
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
        
        if ($Inbound) {
            // Decode JSON `details` menjadi array
            $details = $Inbound->details ?? [];

            DB::beginTransaction();

            try {
                switch (strtoupper($row['kode_jenis_pungutan'])) {
                    case 'BM':
                        $this->updateDetails($details, 'bm', $row);
                        break;
                    case 'PPN':
                        $this->updateDetails($details, 'ppn', $row);
                        break;
                    case 'PPH':
                        $this->updateDetails($details, 'pph', $row);
                        break;
                    case 'PPNBM':
                        $this->updateDetails($details, 'ppnbm', $row);
                        break;
                    default:
                        break;
                }

                $details = $this->updateTotals($details, $row['kode_fasilitas_tarif'], $row['nilai_pungutan']);
                
                // Encode kembali menjadi JSON dan simpan di `Inbound`
                $Inbound->details = $details;
                $Inbound->save();

                DB::commit();
                Log::info('Inbound LevyheetImport berhasil di-update dengan ID: ' . $Inbound->id);

            } catch (\Exception $e) {
                DB::rollBack();
                Log::error('Gagal melakukan insert: LevyheetImport' . $e->getMessage());
                return;
            }
        }

        return $Inbound;
    }

 
    private function updateDetails(&$details, $type, $row)
    {
        $taxKey = strtolower($type);
        $fasilitasTarif = $row['kode_fasilitas_tarif'];

        switch ($fasilitasTarif) {
            case 1: // DIBAYARKAN
                $details["{$taxKey}_dibayarkan"] = $row['nilai_pungutan'];
                break;
            case 3: // DITANGGUHKAN
                $details["{$taxKey}_ditangguhkan"] = $row['nilai_pungutan'];
                break;
            case 4: // BERKALA
                $details["{$taxKey}_berkala"] = $row['nilai_pungutan'];
                break;
            case 5: // DIBEBASKAN
                $details["{$taxKey}_dibebaskan"] = $row['nilai_pungutan'];
                break;
            case 6: // TIDAK DIPUNGUT
                $details["{$taxKey}_tidak_dipungut"] = $row['nilai_pungutan'];
                break;
            case 7: // SUDAH DILUNASI
                $details["{$taxKey}_sudah_dilunasi"] = $row['nilai_pungutan'];
                break;
            case 8: // DIJAMINKAN
                $details["{$taxKey}_dijaminkan"] = $row['nilai_pungutan'];
                break;
            case 9: // DITUNDA
                $details["{$taxKey}_ditunda"] = $row['nilai_pungutan'];
                break;
            default:
                break;
        }
    }
 
    private function updateTotals($details, $fasilitasTarif, $nilaiPungutan)
    {
        switch ($fasilitasTarif) {
            case 1: // DIBAYARKAN
                $details['total_dibayarkan'] = ($details['total_dibayarkan'] ?? 0) + $nilaiPungutan;
                break;
            case 3: // DITANGGUHKAN
                $details['total_ditangguhkan'] = ($details['total_ditangguhkan'] ?? 0) + $nilaiPungutan;
                break;
            case 4: // BERKALA
                $details['total_berkala'] = ($details['total_berkala'] ?? 0) + $nilaiPungutan;
                break;
            case 5: // DIBEBASKAN
                $details['total_dibebaskan'] = ($details['total_dibebaskan'] ?? 0) + $nilaiPungutan;
                break;
            case 6: // TIDAK DIPUNGUT
                $details['total_tidak_dipungut'] = ($details['total_tidak_dipungut'] ?? 0) + $nilaiPungutan;
                break;
            case 7: // SUDAH DILUNASI
                $details['total_sudah_dilunasi'] = ($details['total_sudah_dilunasi'] ?? 0) + $nilaiPungutan;
                break;
            case 8: // DIJAMINKAN
                $details['total_dijaminkan'] = ($details['total_dijaminkan'] ?? 0) + $nilaiPungutan;
                break;
            case 9: // DITUNDA
                $details['total_ditunda'] = ($details['total_ditunda'] ?? 0) + $nilaiPungutan;
                break;
            default:
                break;
        }

        return $details;
    }
}

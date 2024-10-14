<?php
namespace App\Imports;


use App\Models\InboundDetail;
use App\Models\Good; 
use App\Models\MasterUom;
use App\Models\MasterPackage; 
use App\Helpers\GeneralHelper;
use App\Imports\HeaderSheetImport;
use App\Imports\EntitasSheetImport; 
use App\Imports\DocumentSheetImport;
use App\Imports\CarrierSheetImport;  
use App\Imports\PackagingSheetImport; 
use App\Imports\ContainerSheetImport; 
use App\Imports\GoodSheetImport; 
use App\Imports\TariffGoodSheetImport; 
use App\Imports\DocumentGoodSheetImport; 
use App\Imports\GoodVDSheetImport; 
use App\Imports\LevyheetImport; 
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Throwable;
use Illuminate\Support\Facades\Log;

class PebAll implements WithMultipleSheets
{
    protected $bc;
    protected $nomorPengajuan;
    protected $userId;

    public function __construct($bc, $nomorPengajuan, $userId)
    {
        $this->bc = $bc;
        $this->nomorPengajuan = $nomorPengajuan;
        $this->userId = $userId;
    }

    public function sheets(): array
    {  
        $header = new HeaderSheetImport($this->bc, $this->nomorPengajuan, $this->userId);
        return [
            'HEADER'        => $header,
            'ENTITAS'       => new EntitasSheetImport($this->nomorPengajuan,$this->userId),
            'DOKUMEN'       => new DocumentSheetImport($this->nomorPengajuan,$this->userId),
            'PENGANGKUT'    => new CarrierSheetImport($this->nomorPengajuan,$this->userId),
            'KEMASAN'       => new PackagingSheetImport($this->nomorPengajuan,$this->userId),
            'KONTAINER'     => new ContainerSheetImport($this->nomorPengajuan,$this->userId),            
            'BARANG'        => new GoodSheetImport($this->nomorPengajuan,$this->userId),
            'BARANGTARIF'   => new TariffGoodSheetImport($this->nomorPengajuan,$this->userId),
            'BARANGDOKUMEN' => new DocumentGoodSheetImport($this->nomorPengajuan,$this->userId),
            'BARANGVD'      => new GoodVDSheetImport($this->nomorPengajuan,$this->userId),
            'PUNGUTAN'      => new LevyheetImport($this->nomorPengajuan,$this->userId),        
        ];
    }

}

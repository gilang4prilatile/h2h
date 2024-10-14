<?php

namespace App\Services\Hs;

use Exception;
use App\Models\MasterHsCode;
use Illuminate\Http\Request;
use App\Models\MasterHsCodeRegulation;
use App\Http\Requests\Hs\RegulationRequest;
use App\Models\MasterHsCodeRegName;

class RegulationService
{
    private MasterHsCodeRegulation $regulationEntity;
    private MasterHsCode $hsCodeEntity;
    private MasterHsCodeRegName $hsCodeRegNameEntity;
    public string $mainUrl;

    public function __construct(
        MasterHsCodeRegulation $regulationEntity,
        MasterHsCode $hsCodeEntity,
        MasterHsCodeRegName $hsCodeRegNameEntity
    ) {
        $this->regulationEntity = $regulationEntity;
        $this->hsCodeEntity = $hsCodeEntity;
        $this->hsCodeRegNameEntity = $hsCodeRegNameEntity;

        $this->mainUrl = url('hs/regulation');

        view()->share("mainUrl", $this->mainUrl);
    }


}

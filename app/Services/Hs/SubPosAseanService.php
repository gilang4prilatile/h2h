<?php

namespace App\Services\Hs;

use App\Models\MasterHsCodeSubPosAsean;
use Exception;
use Illuminate\Http\Request;
use App\Http\Requests\Hs\SubPosAseanRequest;

class SubPosAseanService
{
    private MasterHsCodeSubPosAsean $subPosAseanEntity;
    public string $mainUrl;

    public function __construct(
        MasterHsCodeSubPosAsean $subPosAseanEntity
    ) {
        $this->subPosAseanEntity = $subPosAseanEntity;

        $this->mainUrl = url('hs/sub-pos-asean');

        view()->share("mainUrl", $this->mainUrl);
    }


}

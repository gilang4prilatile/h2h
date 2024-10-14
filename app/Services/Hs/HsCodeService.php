<?php

namespace App\Services\Hs;

use Exception;
use App\Models\MasterHsCode;
use Illuminate\Http\Request;
use App\Models\MasterHsCodeBag;
use App\Models\MasterHsCodePos;
use App\Models\MasterHsCodeSubPos;
use App\Http\Requests\Hs\HsCodeRequest;
use App\Models\MasterHsCodeBab;
use App\Models\MasterHsCodeSubPosAsean;

class HsCodeService
{
    private MasterHsCode $hsCodeEntity;
    private MasterHsCodeBag $bagEntity;
    private MasterHsCodePos $posEntity;
    private MasterHsCodeSubPos $subPosEntity;
    private MasterHsCodeBab $babEntity;
    private MasterHsCodeSubPosAsean $subPosAseanEntity;

    public string $mainUrl;

    public function __construct(
        MasterHsCode $hsCodeEntity,
        MasterHsCodeBag $bagEntity,
        MasterHsCodePos $posEntity,
        MasterHsCodeSubPos $subPosEntity,
        MasterHsCodeBab $babEntity,
        MasterHsCodeSubPosAsean $subPosAseanEntity
    ) {
        $this->hsCodeEntity = $hsCodeEntity;
        $this->bagEntity = $bagEntity;
        $this->posEntity = $posEntity;
        $this->subPosEntity = $subPosEntity;
        $this->babEntity = $babEntity;
        $this->subPosAseanEntity = $subPosAseanEntity;

        $this->formFields = [
            "bm",
            "ppn",
            "bm_regulation",
            "pph_api",
            "pph_api_regulation",
            "pph_non_api",
            "pph_api_non_regulation",
            "bm_acfta",
            "bm_acfta_regulation",
            "bm_atiga",
            "bm_atiga_regulation",
            "bm_ijepa",
            "bm_akfta",
            "bm_akfta_regulation",
            "bm_aifta",
            "bm_aifta_regulation",
            "bm_aanzfta",
            "bm_aanzfta_regulation",
            "bm_ajcep",
            "bm_ajcep_regulation",
            "bm_iccepa",
            "bm_iccepa_regulation",
            "bm_akhfta",
            "bm_akhfta_regulation",
            "bm_iacepa",
            "bm_iacepa_regulation",
        ];

        $this->mainUrl = url('hs/hs-code');

        view()->share("mainUrl", $this->mainUrl);
    }

}

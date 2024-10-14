<?php

namespace App\Services\Hs;

use App\Models\MasterHsCodeSubPos;
use Exception;
use Illuminate\Http\Request;
use App\Http\Requests\Hs\SubPosRequest;

class SubPosService
{
    private MasterHsCodeSubPos $subPosEntity;
    public string $mainUrl;

    public function __construct(
        MasterHsCodeSubPos $subPosEntity
    ) {
        $this->subPosEntity = $subPosEntity;

        $this->mainUrl = url('hs/sub-pos');

        view()->share("mainUrl", $this->mainUrl);
    }

}

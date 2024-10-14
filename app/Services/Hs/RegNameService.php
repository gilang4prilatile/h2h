<?php

namespace App\Services\Hs;

use App\Models\MasterHsCodeRegName;
use Exception;
use Illuminate\Http\Request;
use App\Http\Requests\Hs\RegNameRequest;

class RegNameService
{
    private MasterHsCodeRegName $regNameEntity;
    public string $mainUrl;

    public function __construct(
        MasterHsCodeRegName $regNameEntity
    ) {
        $this->regNameEntity = $regNameEntity;

        $this->mainUrl = url('hs/reg-name');

        view()->share("mainUrl", $this->mainUrl);
    }

}

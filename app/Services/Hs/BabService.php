<?php

namespace App\Services\Hs;

use App\Models\MasterHsCodeBab;
use Exception;
use Illuminate\Http\Request;
use App\Http\Requests\Hs\BabRequest;

class BabService
{
    private MasterHsCodeBab $babEntity;
    public string $mainUrl;

    public function __construct(
        MasterHsCodeBab $babEntity
    ) {
        $this->babEntity = $babEntity;

        $this->mainUrl = url('hs/bab');

        view()->share("mainUrl", $this->mainUrl);
    }
}
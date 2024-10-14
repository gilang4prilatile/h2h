<?php

namespace App\Services\Hs;

use App\Models\MasterHsCodeBag;
use Exception;
use Illuminate\Http\Request;
use App\Http\Requests\Hs\BagRequest;

class BagService
{
    private MasterHsCodeBag $bagEntity;
    public string $mainUrl;

    public function __construct(
        MasterHsCodeBag $bagEntity
    ) {
        $this->bagEntity = $bagEntity;

        $this->mainUrl = url('hs/bag');

        view()->share("mainUrl", $this->mainUrl);
    }

}

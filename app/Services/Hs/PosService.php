<?php

namespace App\Services\Hs;

use App\Models\MasterHsCodePos;
use Exception;
use Illuminate\Http\Request;
use App\Http\Requests\Hs\PosRequest;

class PosService
{
    private MasterHsCodePos $posEntity;
    public string $mainUrl;

    public function __construct(
        MasterHsCodePos $posEntity
    ) {
        $this->posEntity = $posEntity;

    }

}

<?php

namespace App\Http\Controllers\MasterData;

use App\Http\Controllers\MainController;

class MasterDataController extends MainController
{
    public function __construct()
    {
        parent::__construct();

        $this->view = "master-data.";
    }
}

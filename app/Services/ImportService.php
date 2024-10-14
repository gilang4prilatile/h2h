<?php

namespace App\Services;

use Maatwebsite\Excel\Facades\Excel;
use App\Imports\InboundDetails;
use App\Imports\PibAll;

class ImportService
{
    public function importInboundDetails($file, $idInbound, $userId)
    {
        Excel::import(new InboundDetails($idInbound, $userId), $file);
    }


    public function importAllBc($file, $nomorPengajuan, $userId)
    {
        Excel::import(new PibAll($nomorPengajuan, $userId), $file);
    }
}
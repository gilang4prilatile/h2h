<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Imports\InboundDetails;
use App\Imports\PebAll;
use App\Imports\PibAll;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Log;
use DB;

class ProcessFormBCJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $filePath;
    protected $bc;
    protected $nomorPengajuan;
    protected $userId;

    public function __construct($filePath, $bc, $nomorPengajuan, $userId)
    {
        set_time_limit(3600);
        ini_set('memory_limit', '512M');
        $this->filePath = $filePath;
        $this->bc = $bc;
        $this->nomorPengajuan = $nomorPengajuan;
        $this->userId = $userId; 
    }

    public function handle()
    {
        try {
            //Ambil file dari path yang dikirimkan sebagai string
            //$this->filePath = str_replace('/', DIRECTORY_SEPARATOR, $this->filePath);
            //$fullPath = storage_path('app' . DIRECTORY_SEPARATOR . $this->filePath);
            $fullPath = public_path($this->filePath);
            Log::info('Full path of file: ' . $fullPath);

            if (!file_exists($fullPath)) {
                Log::error("File does not exist: {$fullPath}");
                return;
            }

            DB::beginTransaction();
            if($this->bc == 20){
                Excel::import(new PibAll($this->bc, $this->nomorPengajuan, $this->userId), $fullPath);
            }else {
               Excel::import(new PebAll($this->bc, $this->nomorPengajuan, $this->userId), $fullPath);
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Job failed: ' . $e->getMessage());
        }
    }


}

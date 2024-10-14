<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Imports\InboundDetails;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Log;
use DB;

class ProcessInboundDetailsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $filePath;
    protected $idInbound;
    protected $userId;

    public function __construct($filePath, $idInbound, $userId)
    {
        set_time_limit(3600);
        ini_set('memory_limit', '512M');
        $this->filePath = $filePath;
        $this->idInbound = $idInbound;
        $this->userId = $userId;
       
    }

    public function handle()
    {
        try {
            $this->filePath = str_replace('/', DIRECTORY_SEPARATOR, $this->filePath);
            $fullPath = storage_path('app' . DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR . $this->filePath);
            Log::info('Full path of file: ' . $fullPath);

            if (!file_exists($fullPath)) {
                Log::error("File does not exist: {$fullPath}");
                return;
            }

            $batchSize = 500; // Atur ukuran batch sesuai kebutuhan
            $rows = Excel::toArray(new InboundDetails($this->idInbound, $this->userId), $fullPath)[0];

            DB::beginTransaction();
            foreach ($rows as $index => $row) {
                (new InboundDetails($this->idInbound, $this->userId))->model($row);

                if (($index + 1) % $batchSize == 0) {
                    DB::commit();
                    DB::beginTransaction();
                }
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Job failed: ' . $e->getMessage());
        }
    }
}

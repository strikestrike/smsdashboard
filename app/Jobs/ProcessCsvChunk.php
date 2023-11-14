<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Imports\LeadsImport;
use Maatwebsite\Excel\Facades\Excel;

class ProcessCsvChunk implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $file;

    public function __construct($file)
    {
        $this->file = $file;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $import = new LeadsImport();
        Excel::import($import, $this->file);
        $successCount = $import->getSuccessCount();
        $errorCount = $import->getErrorCount();
        echo "$successCount leads uploaded successfully. $errorCount leads returned errors.";
    }
}

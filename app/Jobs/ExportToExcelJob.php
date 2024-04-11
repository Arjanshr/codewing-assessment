<?php

namespace App\Jobs;

use App\Exports\JsonExport;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Maatwebsite\Excel\Facades\Excel;

class ExportToExcelJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $json;
    protected $response;

    /**
     * Create a new job instance.
     */
    public function __construct($json)
    {
        // dd($json);
        $this->json = $json;
    }

    /**
     * Execute the job.
     */
    public function handle():void
    {
        $export = new JsonExport($this->json);
        Excel::download($export, 'json_upload.xlsx');
    }
}

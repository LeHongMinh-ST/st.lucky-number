<?php

namespace App\Jobs;

use App\Imports\MemberImport;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Maatwebsite\Excel\Facades\Excel;

class MemberImportJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(
        private $file,
        private $campaignId
    )
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Excel::import(new MemberImport($this->campaignId), $this->file);
    }
}

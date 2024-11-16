<?php

namespace App\Jobs;

use App\Events\Employees\EmployeeImportFailed;
use App\Events\Employees\EmployeeImportFinished;
use App\Imports\EmployeesImport;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class EmployeeImportJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(private string $excelPath)
    {
        $this->onQueue('default_long');
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $import = new EmployeesImport();
        $import->import(filePath: $this->excelPath, disk: 'local');

        if ($import->failures()->isNotEmpty()) {
            EmployeeImportFailed::dispatch($import->failures());
        }

        if ($import->errors()->isNotEmpty()) {
            Log::error('' . $import->errors()->implode(', '));
        }

        EmployeeImportFinished::dispatch();
    }
}

<?php

namespace App\Services;

use App\Jobs\EmployeeImportJob;
use App\Repositories\EmployeeRepository;
use Illuminate\Support\Facades\Storage;

class EmployeeService
{
    public function __construct(protected EmployeeRepository $employeeRepository)
    {
    }

    public function findAll(array $request)
    {
        $employees = $this->employeeRepository->findAll($request);
        return $employees;
    }

    public function import($file)
    {
        $filePath = $this->storeFileinTempStorage($file);
        EmployeeImportJob::dispatch($filePath);
    }

    private function storeFileinTempStorage($file)
    {
        $path = 'tmp/employees/excel-imports';
        $filePath = Storage::disk('local')->putFileAs(
            $path,
            $file,
            $file->getClientOriginalName()
        );

        return $filePath;
    }

    public function find(int $id)
    {
        $employee = $this->employeeRepository->find($id);
        return $employee;
    }

    public function delete(int $id)
    {
        return $this->employeeRepository->delete($id);
    }
}

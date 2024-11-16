<?php

namespace App\Services;

use App\Helpers\UploadHelper;
use App\Jobs\EmployeeImportJob;
use App\Repositories\EmployeeRepository;
use Illuminate\Http\UploadedFile;

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

    public function import(UploadedFile $file)
    {
        $filePath = UploadHelper::store($file, 'tmp/employees/excel-imports');
        EmployeeImportJob::dispatch($filePath);
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

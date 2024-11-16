<?php

namespace App\Http\Controllers\Employees;

use App\Http\Controllers\Controller;
use App\Http\Requests\Employees\GetEmployeesRequest;
use App\Http\Requests\Employees\ImportExployeesRequest;
use App\Services\EmployeeService;

class EmployeeController extends Controller
{
    public function index(GetEmployeesRequest $request, EmployeeService $service)
    {
        $data = $request->validated();

        $employees = $service->findAll($data);

        return $this->apiResponse
            ->setData('employees', $employees)
            ->json();
    }

    public function import(ImportExployeesRequest $request, EmployeeService $service)
    {
        $service->import($request->file('file'));

        return $this->apiResponse
            ->setMessage('successfully deleted employee!')
            ->json();
    }

    public function show($id, EmployeeService $service)
    {
        $employee = $service->find($id);

        return $this->apiResponse
            ->setData('employee', $employee)
            ->json();
    }

    public function delete($id, EmployeeService $service)
    {
        $service->delete($id);

        return $this->apiResponse
            ->setMessage('successfully deleted employee!')
            ->json();
    }
}

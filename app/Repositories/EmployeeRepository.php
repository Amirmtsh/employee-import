<?php

namespace App\Repositories;

use App\Models\Employee;
use App\Repositories\Interfaces\ModelRepositoryInterface;

class EmployeeRepository implements ModelRepositoryInterface
{
    public function find($id): Employee
    {
        return Employee::findOrFail($id);
    }

    public function create($request) {}

    public function update($id) {}

    public function findAll($request)
    {
        return Employee::filter([
            'search' => $request['search'] ?? null,
            'gender' => $request['gender'] ?? null,
        ])->paginate($request['per_page'] ?? 30);
    }

    public function delete($employee)
    {
        return $employee->delete();
    }
}

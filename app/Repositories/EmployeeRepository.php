<?php

namespace App\Repositories;

use App\Models\Employee;
use App\Repositories\Interfaces\ModelRepositoryInterface;

class EmployeeRepository implements ModelRepositoryInterface
{
    public function find(int $id): Employee
    {
        return Employee::findOrFail($id);
    }

    public function create(array $request) {}

    public function update(array $request,int $id) {}

    public function findAll(array $request)
    {
        return Employee::filter([
            'search' => $request['search'] ?? null,
            'gender' => $request['gender'] ?? null,
        ])->paginate($request['per_page'] ?? 30);
    }

    public function delete(int $id)
    {
        $this->find($id)->delete();
    }
}

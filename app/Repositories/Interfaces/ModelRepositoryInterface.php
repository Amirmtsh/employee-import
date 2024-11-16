<?php

namespace App\Repositories\Interfaces;

interface ModelRepositoryInterface
{
    public function find($id);

    public function create($request);

    public function update($id);

    public function findAll($request);

    public function delete($employee);
}

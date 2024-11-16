<?php

namespace App\Repositories\Interfaces;

interface ModelRepositoryInterface
{
    public function find(int $id);

    public function create(array $request);

    public function update(array $request,int $id);

    public function findAll(array $request);

    public function delete(int $id);
}

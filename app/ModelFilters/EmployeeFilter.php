<?php

namespace App\ModelFilters;

use App\Models\Employee;
use EloquentFilter\ModelFilter;

class EmployeeFilter extends ModelFilter
{
    /**
     * Related Models that have ModelFilters as well as the method on the ModelFilter
     * As [relationMethod => [input_key1, input_key2]].
     *
     * @var array
     */
    public $relations = [];

    public function search(string $search)
    {
        return $this->where(
            fn($query) =>
            $query->where('employee_id', 'LIKE', "%$search%")
                ->orWhere('username', 'LIKE', "%$search%")
                ->orWhere('first_name', 'LIKE', "%$search%")
                ->orWhere('last_name', 'LIKE', "%$search%")
                ->orWhere('city', 'LIKE', "%$search%")
                ->orWhere('country', 'LIKE', "%$search%")
                ->orWhere('region', 'LIKE', "%$search%")
        );
    }

    public function gender(string $gender)
    {
        return $this->where('gender', Employee::GENDERS[$gender]);
    }
}

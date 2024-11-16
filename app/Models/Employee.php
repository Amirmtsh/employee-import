<?php

namespace App\Models;

use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory, Filterable;

    const GENDERS = [
        'male' => 'M',
        'female' => 'F',
    ];

    protected $guarded = [];
}

<?php

use App\Http\Controllers\Employees\EmployeeController;
use Illuminate\Support\Facades\Route;

Route::prefix('employee')->controller( EmployeeController::class)->group(function () {
    Route::get('/', 'index');
    Route::post('/', 'import');
    Route::get('/{id}', 'show');
    Route::delete('/{id}', 'delete');
});

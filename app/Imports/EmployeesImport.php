<?php

namespace App\Imports;

use App\Models\Employee;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class EmployeesImport implements ToModel, SkipsEmptyRows, WithValidation, WithHeadingRow, SkipsOnFailure, WithChunkReading, WithBatchInserts, SkipsOnError
{
    use Importable, SkipsErrors, SkipsFailures;

    public function model(array $row)
    {
        return new Employee([
            'employee_id' => $row['emp_id'],
            'username' => $row['user_name'],
            'name_prefix' => $row['name_prefix'],
            'first_name' => $row['first_name'],
            'middle_initial' => $row['middle_initial'],
            'last_name' => $row['last_name'],
            'gender' => $row['gender'],
            'email' => $row['e_mail'],
            'date_of_birth' => Carbon::createFromFormat('m/d/Y', $row['date_of_birth'])->format('Y-m-d'),
            'time_of_birth' =>  Carbon::createFromFormat('h:i:s A', $row['time_of_birth'])->format('H:i:s'),
            'age_in_years' => $row['age_in_yrs'],
            'date_of_joining' => Carbon::createFromFormat('m/d/Y', $row['date_of_joining'])->format('Y-m-d'),
            'age_in_company' => $row['age_in_company_years'],
            'phone_no' => $row['phone_no'],
            'place_name' => $row['place_name'],
            'country' => $row['county'],
            'city' => $row['city'],
            'zip' => $row['zip'],
            'region' => $row['region'],
        ]);
    }

    public function chunkSize(): int
    {
        return 500;
    }

    public function batchSize(): int
    {
        return 500;
    }

    public function rules(): array
    {
        return [
            'emp_id' => ['required', 'numeric', 'unique:employees,employee_id'],
            'user_name' => ['required', 'string', 'min:3', 'max:50', 'unique:employees,username'],
            'name_prefix' => ['required', 'string', 'min:1', 'max:20'],
            'first_name' => ['required', 'string', 'min:1', 'max:50'],
            'middle_initial' => ['required', 'string', 'min:1', 'max:10'],
            'last_name' => ['required', 'string', 'min:1', 'max:50'],
            'gender' => ['required', 'string', 'in:M,F'],
            'e_mail' => ['required', 'email', 'min:4', 'max:150'],
            'date_of_birth' => ['required', 'string', 'regex:/^(0?[1-9]|1[0-2])\/(0?[1-9]|[12][0-9]|3[01])\/\d{4}$/'],
            'time_of_birth' => ['required', 'string', 'regex:/^((0?[1-9]|1[0-2]):([0-5][0-9]):([0-5][0-9]) (AM|PM))$/'],
            'age_in_yrs' => ['required', 'numeric'],
            'date_of_joining' => ['required', 'string', 'regex:/^(0?[1-9]|1[0-2])\/(0?[1-9]|[12][0-9]|3[01])\/\d{4}$/'],
            'age_in_company_years' => ['required', 'numeric'],
            'phone_no' => ['required', 'string', 'regex:/^\d{3}-\d{3}-\d{4}$/'],
            'place_name' => ['required', 'string', 'min:1', 'max:50'],
            'county' => ['required', 'string', 'min:1', 'max:50'],
            'city' => ['required', 'string', 'min:1', 'max:50'],
            'zip' => ['required', 'regex:/\b\d{4,5}\b/'],
            'region' => ['required', 'string', 'min:1', 'max:50'],
        ];
    }
}

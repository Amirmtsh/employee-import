<?php

namespace Tests\Feature;

use App\Models\Employee;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Maatwebsite\Excel\Facades\Excel;
use Tests\TestCase;

class EmployeeTest extends TestCase
{
    use RefreshDatabase;
    public function test_find_all_employees()
    {
        Employee::factory()->count(5)->create();
        $response = $this->get('api/employee');
        $response->assertStatus(200);
        $this->assertEquals(count($response['data']['employees']), 5);
        $this->assertDatabaseCount('employees', 5);
    }

    public function test_delete_employee()
    {
        $employee =  Employee::factory()->count(1)->create();
        $this->assertDatabaseCount('employees', 1);
        $response = $this->delete('api/employee/' . $employee[0]['id']);
        $response->assertStatus(200);
        $this->assertDatabaseCount('employees', 0);
    }


    public function test_show_employee()
    {
        $employee = Employee::factory()->count(1)->create();
        $this->assertDatabaseCount('employees', 1);
        $response = $this->get('api/employee/' . $employee[0]['id']);
        $response->assertStatus(200);
        $this->assertEquals($response['data']['employee']['id'], $employee[0]['id']);
    }

    public function test_excels_can_be_uploaded(): void
    {
        Excel::fake();

        $file = UploadedFile::fake()->create('test.csv', 2000);

        $response = $this->post('/api/employee', ['file' => $file]);

        $response->assertStatus(200);
    }
}

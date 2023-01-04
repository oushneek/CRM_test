<?php

namespace Tests\Feature;

use App\Models\Company;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class EmployeeCrudTest extends TestCase
{
    use RefreshDatabase;
    public function test_authorized_user_can_access_employees(){
        $user = User::factory()->create();
        $company= Company::factory()->create();

        $respone = $this->actingAs($user)->get('/employees/'.$company->id);
        $respone->assertStatus(200);
    }

    public function test_unauthorized_user_cannot_access_employees(){
        $company= Company::factory()->create();

        $response = $this->get('/employees/'.$company->id);
        $response->assertStatus(302);
        $response->assertRedirect('/login');
    }

    public function test_authorized_user_can_access_employee_create_route(){
        $user = User::factory()->create();
        $company= Company::factory()->create();
        $response = $this->actingAs($user)->get('/employee/create/'.$company->id);
        $response->assertStatus(200);
    }

    public function test_unauthorized_user_cannot_access_employee_create_route(){
        $company= Company::factory()->create();
        $response = $this->get('/employee/create/'.$company->id);
        $response->assertStatus(302);
        $response->assertRedirect('/login');
    }

    public function test_authorized_user_can_store_employee()
    {
        $user = User::factory()->create();
        $company= Company::factory()->create();
        $response = $this->actingAs($user)->post('/employee/store', [
            'first_name' => 'First',
            'last_name' => 'Last',
            'company_id'=>$company->id
        ]);
        $response->assertSessionHasNoErrors();
        $response->assertStatus(302);
        $response->assertRedirect('/employees/'.$company->id);
        $this->assertCount(1, Employee::all());
        $this->assertDatabaseHas('employees', ['first_name' => 'First']);
        $this->assertDatabaseHas('employees', ['last_name' => 'Last']);
        $this->assertDatabaseHas('employees', ['company_id' => $company->id]);

    }

    public function test_authorized_user_can_access_employee_edit_route()
    {
        $user = User::factory()->create();
        $company = Company::factory()->create();
        $this->actingAs($user)->post('/employee/store', [
            'first_name' => 'First',
            'last_name' => 'Last',
            'company_id'=>$company->id
        ]);
        $employee=Employee::first();
        $response = $this->actingAs($user)->get('/employee/' . $employee->id . '/edit');
        $response->assertStatus(200);
        $response->assertSee($employee->first_name);
    }

    public function test_unauthorized_user_cannot_access_employee_edit_route()
    {
        $company = Company::factory()->create();
        $response=$this->post('/employee/store', [
            'first_name' => 'First',
            'last_name' => 'Last',
            'company_id'=>$company->id
        ]);
        $response->assertSessionMissing('user');
    }

    public function test_authorized_user_can_update_company()
    {
        $user = User::factory()->create();
        $company=Company::factory()->create();
        $this->actingAs($user)->post('/employee/store', [
            'first_name' => 'First',
            'last_name' => 'Last',
            'company_id'=>$company->id
        ]);
        $this->assertCount(1, Employee::all());
        $employee=Employee::first();
        $response = $this->actingAs($user)->put('/employee/' . $employee->id . '/update', [
            'first_name' => 'FirstUpdated',
            'last_name' => 'FirstUpdated',
            'company_id'=>$company->id
        ]);
        $response->assertSessionHasNoErrors();
        $response->assertStatus(302);
        $response->assertRedirect('/employees/'.$company->id);
        $this->assertEquals('FirstUpdated', Employee::first()->first_name);
        $this->assertEquals('FirstUpdated', Employee::first()->last_name);
    }

    public function test_authorized_user_can_delete_company()
    {
        $user = User::factory()->create();
        $company = Company::factory()->create();
        $this->actingAs($user)->post('/employee/store', [
            'first_name' => 'First',
            'last_name' => 'Last',
            'company_id'=>$company->id
        ]);
        $this->assertCount(1, Employee::all());
        $employee=Employee::first();
        $response = $this->actingAs($user)->delete('/employee/'.$employee->id.'/delete');
        $this->assertCount(0, Employee::all());
        $response->assertStatus(302);
        $response->assertRedirect('/employees/'.$company->id);


    }
}

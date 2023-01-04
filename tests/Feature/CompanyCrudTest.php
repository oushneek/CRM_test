<?php

namespace Tests\Feature;

use App\Models\Company;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CompanyCrudTest extends TestCase
{
    use RefreshDatabase;

    public function test_authorized_user_can_access_companies(){
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get('/companies');
        $response->assertStatus(200);
    }

    public function test_unauthorized_user_cannot_access_companies(){
        $response = $this->get('/companies');
        $response->assertStatus(302);
        $response->assertRedirect('/login');
    }

    public function test_authorized_user_can_access_company_create_route(){
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get('/company/create');
        $response->assertStatus(200);
    }

    public function test_unauthorized_user_cannot_access_company_create_route(){
        $response = $this->get('/company/create');
        $response->assertStatus(302);
        $response->assertRedirect('/login');
    }

    public function test_authorized_user_can_store_company()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->post('/company/store', [
            'name' => 'Company',
        ]);
        $response->assertSessionHasNoErrors();
        $response->assertStatus(302);
        $response->assertRedirect('/companies');
        $this->assertCount(1, Company::all());
        $this->assertDatabaseHas('companies', ['name' => 'Company']);
    }

    public function test_authorized_user_can_access_company_edit_route()
    {
        $user = User::factory()->create();
        $company = Company::factory()->create();
        $response = $this->actingAs($user)->get('/company/' . $company->id . '/edit');
        $response->assertStatus(200);
        $response->assertSee($company->name);
    }

    public function test_unauthorized_user_cannot_access_company_edit_route()
    {
        $company = Company::factory()->create();
        $response = $this->get('/company/' . $company->id . '/edit');
        $response->assertStatus(302);
        $response->assertRedirect('/login');

    }

    public function test_authorized_user_can_update_company()
    {
        $user = User::factory()->create();
        Company::factory()->create();
        $this->assertCount(1, Company::all());
        $company = Company::first();
        $response = $this->actingAs($user)->put('/company/' . $company->id . '/update', [
            'name' => 'Updated Company',
            'email' => 'New@email.com'
        ]);
        $response->assertSessionHasNoErrors();
        $response->assertStatus(302);
        $response->assertRedirect('/companies');
        $this->assertEquals('Updated Company', Company::first()->name);
        $this->assertEquals('New@email.com', Company::first()->email);
    }

    public function test_authorized_user_can_delete_company()
    {
        $user = User::factory()->create();
        $company = Company::factory()->create();
        $this->assertCount(1, Company::all());
        $response = $this->actingAs($user)->delete('/company/'.$company->id.'/delete');
        $this->assertCount(0, Company::all());
        $response->assertStatus(302);
        $response->assertRedirect('/companies');


    }
}

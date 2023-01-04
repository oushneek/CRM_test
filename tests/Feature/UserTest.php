<?php

namespace Tests\Feature;

use App\Models\Company;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;
    public function test_login_redirect_to_home_successfully(){
        User::factory()->create([
            'email' => 'test@test.com',
            'password'=> bcrypt('password')
        ]);

        $response = $this->post('/login',[
            'email'=>'test@test.com',
            'password'=>'password'
        ]);

        $response->assertStatus(302);
        $response->assertRedirect('/home');
    }

    public function test_authorized_user_can_access_home(){
        $user = User::factory()->create();
        $respone = $this->actingAs($user)->get('/home');
        $respone->assertStatus(200);
    }

    public function test_unauthorized_user_cannot_access_home(){
        $response = $this->get('/home');
        $response->assertStatus(302);
        $response->assertRedirect('/login');
    }


}

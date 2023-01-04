<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_register_route_is_disabled(){
        $response = $this->get('/register');
        $response->assertStatus(404);
    }

    public function test_reset_password_route_is_disabled(){
        $response = $this->get('/reset');
        $response->assertStatus(404);
    }

    public function test_confirm_password_route_is_disabled(){
        $response = $this->get('/confirm');
        $response->assertStatus(404);
    }

}

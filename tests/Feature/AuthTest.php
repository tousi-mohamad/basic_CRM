<?php

namespace Tests\Feature;


use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthTest extends TestCase
{
use RefreshDatabase;
    public function test_redirect_to_product()
    {

       $user = \App\Models\User::factory()->create([
          'email' => 'test@test.com',
          'password' => bcrypt('123123123')
       ]);

       $response = $this->post('/login',[
           'email' => 'test@test.com',
           'password' => '123123123'
       ]);

        $response->assertStatus(302);
        $response->assertRedirect('products');
    }
    public function test_unauthenticated_user_cannot_access_product()
    {

        $response = $this->get('/products');

        $response->assertStatus(302);
        $response->assertRedirect('login');
    }
}

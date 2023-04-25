<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class AdminMiddlewareTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function testGuestCannotAccessAdminPanel(){
        $response = $this->get('/admin');
        $response->assertStatus(404);
    }
    public function testUserCannotAccessAdminPanel(){
        $user = User::factory()->create([
           'password'=>bcrypt($password = 'password'),
        ]);
        $response = $this->post('/login',[
            'email'=>$user->email,
            'password'=>$password,
        ]);
        $this->assertAuthenticatedAs($user);
        $response = $this->get('admin');
        $response->assertStatus(404);
    }
    public function testAdminCanAccessAdminPanel(){
        $user = User::factory()->create([
           'password'=>bcrypt($password = 'password'),
            'is_admin' => 1,
        ]);
        $response = $this->post('/login', [
           'email'=>$user->email ,
            'password'=>$password,
        ]);
        $response->assertStatus(302);
        $response = $this->get('admin');

    }
}

<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
class LoginTest extends TestCase
{
    use DatabaseTransactions;

    public function testUserCanLoginWithCorrectData(){
        $user = User::factory()->create([
            'password'=>bcrypt($password = '123'),
        ]);
        $response = $this->post('/login',[
           'email'=>$user->email,
           'password'=>$password,
        ]);
        $response->assertStatus(302);
        $this->assertAuthenticatedAs($user);
    }
    public function testUserCanLoginWithIncorrectData(){
        $user = User::factory()->create([
            'password'=>bcrypt($password = '123'),
        ]);
        $response = $this->post('/login',[
            'email'=>$user->email,
            'password'=>'jaja',
        ]);
        $response->assertStatus(302);
        $this->assertGuest();
    }
}

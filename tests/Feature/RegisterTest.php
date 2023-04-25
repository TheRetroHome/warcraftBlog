<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
class RegisterTest extends TestCase
{
    use DatabaseTransactions;

    public function testUserCanRegister(){
        $response = $this->post('register',[
            'name'=>'Test',
            'email'=>'test@gmail.com',
            'password'=>'password',
            'password_confirmation'=>'password'
        ]);
        $response->assertStatus(302);
        $this->assertDatabaseHas('users',[
           'name'=>'Test',
            'email'=>'test@gmail.com'
        ]);

    }
}

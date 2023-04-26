<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
class CategoryTest extends TestCase
{
    use DatabaseTransactions;

    public function testAdminCanAddCategory(){
        $user = User::factory()->create([
           'password'=>bcrypt($password='password'),
            'is_admin'=>1,
        ]);
        $response = $this->post('/login', [
           'email'=>$user->email,
           'password'=>$password
        ]);
        $response->assertStatus(302);
        $response = $this->get('/admin/category/create');
        $response = $this->post(route('category.store'),[
           'title'=>'title',
        ]);
        $response->assertStatus(302);
        $this->assertDatabaseHas('categories', [
            'title'=>'title',
        ]);
    }
}

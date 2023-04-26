<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
class PostTest extends TestCase
{

    use DatabaseTransactions;

    public function testAdminCanAddPost(){
        $user = User::factory()->create([
            'password'=>bcrypt($password='password'),
            'is_admin'=>1,
        ]);
        $response = $this->post('/login', [
            'email'=>$user->email ,
            'password'=>$password,
        ]);
        $response->assertStatus(302);
        $response = $this->get('/admin/post/create');
        $response = $this->post(route('post.store'),[
            'title'=>'asdafs',
            'description'=>'sdfsdffds',
            'content'=>'adfasdads',
            'category_id'=>1
        ]);
        $response->assertStatus(302);
        $this->assertDatabaseHas('posts', [
            'title'=>'asdafs',
            'description'=>'sdfsdffds',
            'content'=>'adfasdads',
            'category_id'=>1
        ]);
    }
}

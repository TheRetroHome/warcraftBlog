<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\LoginRequest;
use App\Models\Post;
class HomeController extends Controller
{
    public function home(){
        $posts = Post::orderBy('created_at', 'desc')->paginate(6);
        $pagination = $posts->links('pagination::bootstrap-4');
        return view('main.index',compact('posts','pagination'));
    }
    public function loginForm(){
        return view('main.login');
    }
    public function registerForm(){
        return view('main.register');
    }
    public function login(LoginRequest $request){
        Auth::attempt($request->only('email','password'));
        if(Auth::check() && Auth::user()->is_admin){
            return redirect()->route('admin.index')->with('success','Авторизация пройдена, привет Админ!');
    }
        else{
            return redirect()->route('home')->with('success','Авторизация пройдена');
        }
    }
    public function register(UserRequest $request){
    $user = User::create([
        'name'=>$request->name,
        'email'=>$request->email,
        'password'=>bcrypt($request->password),
    ]);
    Auth::login($user);
    return redirect()->route('home')->with('success','Регистрация пройдена');
    }
    public function logout(){
        Auth::logout();
        return redirect()->route('home');
    }
    public function show($slug){
        $post = Post::where('slug',$slug)->firstOrFail();
        $post->views += 1;
        $post->update();
        return view('main.single',compact('post'));
    }
    public function showCategoryPosts($slug){
      $category = Category::where('slug',$slug)->firstOrfail();
      $posts = $category->posts()->orderBy('id','desc')->paginate(5);
      $pagination = $posts->links('pagination::bootstrap-4');
      return view('main.category',compact('category','posts','pagination'));
    }
}

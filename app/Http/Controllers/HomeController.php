<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\LoginRequest;
class HomeController extends Controller
{
    public function home(){
        return view('main.index');
    }
    public function loginForm(){
        return view('main.login');
    }
    public function registerForm(){
        return view('main.register');
    }
    public function login(LoginRequest $request){
        Auth::attempt($request->only('email','password'));
        if(Auth::user()->is_admin){
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
}

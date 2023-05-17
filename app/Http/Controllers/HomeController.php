<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\LoginRequest;
use App\Models\Post;
use App\Http\Requests\ForgotPasswordRequest;
use Illuminate\Support\Str;
use App\Mail\ForgotPasswordMail;
use Illuminate\Support\Facades\Mail;
class HomeController extends Controller
{
    public function home(){                 //Вывод данных на страничку "/",
        $posts = Post::withCount('likes')   //Пагинация по 6 штук, сортировка по кол-ву лайков
            ->orderBy('likes_count', 'desc')//Если лайков везде одинаковое кол-во, то сортировка по дате создания
            ->orderBy('created_at', 'desc')
            ->paginate(6);
        $pagination = $posts->links('pagination::bootstrap-4');
        return view('main.index',compact('posts','pagination'));
    }
    public function loginForm(){          //Вид логина
        return view('main.login');
    }
    public function registerForm(){      //Вид регистрации
        return view('main.register');
    }
    public function login(LoginRequest $request){
        if(Auth::attempt($request->only('email','password'))){  //Попытка авторизации используя лишь email и пароль
            if(Auth::check() && Auth::user()->is_admin){             //Проверка, если пользователь авторизован, и он админ, его перебросит на админ панель
                return redirect()->route('admin.index')->with('success','Авторизация пройдена, привет Админ!');
            }
            else{
                return redirect()->route('home')->with('success','Авторизация пройдена');
            }
        }
        else{
            return redirect()->back()->withErrors(['error' => 'Неправильный email или пароль']);
        }
    }
    public function register(UserRequest $request){
    $user = User::create([                         //Стандартное созданрие пользователя
        'name'=>$request->name,
        'email'=>$request->email,
        'password'=>bcrypt($request->password),
    ]);
    Auth::login($user);                           //Авторизация после его успешной регистрации
    return redirect()->route('home')->with('success','Регистрация пройдена');
    }
    public function logout(){
        Auth::logout();                         //Выход из учетной записи
        return redirect()->route('home');
    }
    public function show($slug){               //Логика просмотров. При просмотре поста, его значение увеличивается на += 1
        $post = Post::where('slug',$slug)->firstOrFail();
        $post->views += 1;
        $post->update();
        $comments = $post->comments()->paginate(10);  //Пагинация комментов
        return view('main.single',compact('post','comments'));
    }
    public function showCategoryPosts($slug){   //Логика вывода одиночной странички категории
      $category = Category::where('slug',$slug)->firstOrfail();    //Берём категорию соответствующую слагу
      $posts = $category->posts()->orderBy('id','desc')->paginate(6); //Пагинируем посты, принадлежащие ей по 6 штук
      $pagination = $posts->links('pagination::bootstrap-4');         //Добавляем красивую пагинацию от бутстрапа
      return view('main.category',compact('category','posts','pagination')); //отправляем данные в вид
    }
    public function forgotPassword(){
        return view('main.mail.forgotPassword');
    }
    public function storeForgotPassword(ForgotPasswordRequest $request){
        $newPassword = Str::random(10);
        $user = User::where('email',$request->email)->firstOrFail();
        $user->password = bcrypt($newPassword);
        $user->save();
        Mail::to($request->email)->send(new ForgotPasswordMail($newPassword));
        return redirect('/')->with('success','Пароль был сброшен');
    }
}

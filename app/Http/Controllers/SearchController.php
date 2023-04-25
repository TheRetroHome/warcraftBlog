<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
class SearchController extends Controller
{
    public function index(Request $request){
    $request->validate([
        's'=>'required',        //Валидация поисковой строки
    ]);
    $s = $request->s;        //Заключаем в переменную
    $count = Post::count(); //Производим подсчёт чтобы в дальнейшем показать пользователю сколько было найдено постов
    $posts = Post::like($s)->with('category')->paginate(3);   //Используем scopeLike из модели Post
    $pagination = $posts->links('pagination::bootstrap-4');   //Передадим красивую пагинацию
    return view('main.search',compact('posts','s','pagination','count')); //Отправляем данные
    }
}

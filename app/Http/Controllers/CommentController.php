<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Comment;
class CommentController extends Controller
{
    public function store(Request $request, Post $post)
    {
        $request->validate([
            'body' => 'required',    //Валидируем комментарий
        ]);

        $comment = Comment::create(['body' => $request->body,'user_id'=>auth()->id(),'post_id' => $post->id,]); //Создаем комментарий и заполняем данные в базу
        return redirect()->back();
    }
    public function destroy(Comment $comment)
    {
        if (auth()->user()->is_admin || auth()->id() == $comment->user_id) {  //Если пользователь админ или владелец коммента, он сможет его удалить
            $comment->delete();
            return redirect()->back()->with('success', 'Комментарий успешно удален');
        } else {
            return redirect()->back()->with('error', 'У вас нет прав для удаления этого комментария'); //Если нет, редиректает с ошибкой
        }
    }
}

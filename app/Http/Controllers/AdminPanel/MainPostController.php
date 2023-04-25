<?php

namespace App\Http\Controllers\AdminPanel;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Http\Requests\PostRequest;
use Illuminate\Support\Facades\Storage;
class MainPostController extends Controller
{
    /**
     * Стандартный CRUD (вывод постов, создание, редактирование, обновление, удаление)
     */
    public function index()
    {
        $posts = Post::with('category')->paginate(5); //Загрузка постов и категорий для каждого поста (избегаю проблему n+1)
        $pagination = $posts->links('pagination::bootstrap-4'); //Красивая пагинация отправлена в вид
        return view('admin.posts.index',compact('posts','pagination'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all()->pluck('title','id'); //Передаём в вид всех категорий
        return view('admin.posts.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostRequest $request)
    {
        $data = $request->validated();  //Валидируем данные моим кастомные реквестом
        $data['thumbnail']= Post::uploadImage($request); //Воспользуемся методом который находися в моделе (создает папку и помещает туда картинку)
        Post::create($data);
        return redirect()->route('post.index')->with('success','Пост успешно добавлен');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        $categories = Category::pluck('title','id')->all(); //Передаём в вид всех категорий
        return view('admin.posts.edit',compact('categories','post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PostRequest $request, Post $post)
    {
        $data = $request->all();
        if($file = Post::uploadImage($request,$post->thumbnail)){
            $data['thumbnail'] = $file;
        } //Если у пользователя есть картинка, мы её обновим
        $post->update($data);
        return redirect()->route('post.index')->with('success','Пост успешно редактирован');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        if($post->thumbnail){
            Storage::disk('public')->delete($post->thumbnail);  //Удаление картинки, если она закреплена за пользователем
        }
        $post->delete();
        return redirect()->route('post.index')->with('success','Пост успешно удалён');
    }
}

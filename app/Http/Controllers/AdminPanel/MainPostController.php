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
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::with('category')->paginate(5);
        $pagination = $posts->links('pagination::bootstrap-4');
        return view('admin.posts.index',compact('posts','pagination'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all()->pluck('title','id');
        return view('admin.posts.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostRequest $request)
    {
        $data = $request->validated();
        $data['thumbnail']= Post::uploadImage($request);
        $post = Post::create($data);
        return redirect()->route('post.index')->with('success','Пост успешно добавлен');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        $categories = Category::pluck('title','id')->all();
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
        }
        $post->update($data);
        return redirect()->route('post.index')->with('success','Пост успешно редактирован');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        if($post->thumbnail){
            Storage::disk('public')->delete($post->thumbnail);
        }
        $post->delete();
        return redirect()->route('post.index')->with('success','Пост успешно удалён');
    }
}

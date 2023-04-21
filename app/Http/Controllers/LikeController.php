<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
class LikeController extends Controller
{
    public function store(Post $post)
    {
        $post->likes()->create([
            'user_id' => auth()->id(),
        ]);

        return back();
    }

    public function destroy(Post $post)
    {
        $post->likes()->where('user_id', auth()->id())->delete();
        return back();
    }
}

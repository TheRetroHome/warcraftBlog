<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
class SearchController extends Controller
{
    public function index(Request $request){
    $request->validate([
        's'=>'required',
    ]);
    $s = $request->s;
    $posts = Post::like($s)->with('category')->paginate(2);
    $pagination = $posts->links('pagination::bootstrap-4');
    return view('main.search',compact('posts','s','pagination'));
    }
}

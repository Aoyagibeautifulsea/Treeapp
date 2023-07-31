<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Creator;

class ToppageController extends Controller
{
    // <--最新投稿表示-->
public function toppage(Request $request)
    {
        $keyword = $request->input('keyword');

        $query = Post::query();

        if(!empty($keyword)) {
            $query->where('title', 'LIKE', "%{$keyword}%")
                ->orWhere('author', 'LIKE', "%{$keyword}%");
        }

        $posts = $query->get();

        return view('posts.toppage', compact('posts', 'keyword'));
     }
}

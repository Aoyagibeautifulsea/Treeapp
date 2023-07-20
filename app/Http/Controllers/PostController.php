<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\creator;

class PostController extends Controller
{
    
//   <--詳細表示-->
    public function show(Post $post)
{
    return view('posts.show')->with(['post' => $post]);
}
   
}

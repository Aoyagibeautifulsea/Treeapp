<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    public function toppage(Post $post)
{
    return view('posts.toppage')->with(['posts' => $post->getPaginateByLimit()]);
}

}

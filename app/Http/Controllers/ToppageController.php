<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\creator;

class ToppageController extends Controller
{
    // <--最新投稿表示-->
    public function toppage(Post $post)
{
    return view('posts.toppage')->with(['posts' => $post->gettoppage()]);
}
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;

class MypageController extends Controller
{
     public function showmypage()
    {
        // ログインしているユーザーのIDを取得
        $userId = auth()->id();

        // ユーザーの投稿を取得
        $user = User::with('posts')->find($userId);
        // ログインユーザーのいいねした投稿を取得
        $likedPosts = $user->favoritePosts;

        return view('mypages.mypage', compact('user', 'likedPosts'));
    }
}
